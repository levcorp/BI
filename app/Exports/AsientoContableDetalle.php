<?php
namespace App\Exports;
use App\DetalleSolicitud as Articulos;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\RendicionViaticosDetalle;
use App\RendicionSolicitud;
use App\User;
use DB;
use Carbon\Carbon;
use App\CamposVaciosRendicion;
use App\CentroCostos;
use DateTime;
class AsientoContableDetalle implements FromQuery, WithMapping,WithHeadings
{
    use Exportable;
    public $solicitud_id;
    public $index;
    public $state;
    public function __construct(int $solicitud_id)
    {
        $this->solicitud_id = $solicitud_id;
        $this->index = -1;
    }
    public function headings(): array
    {
        return [
            [
                'Recordkey',
                'Line_ID',
                'AccountCode',
                'ShortName',
                'Reference1',
                'Reference2',
                'FCDebit',
                'FCCredit',
                'Debit',
                'Credit',
                'DueDate',
                'CostingCode2'
            ],
            [
                'Recordkey',
                'Row Number',
                'Cuenta',
                'ShortDescripcion',
                'Ref1',
                'Ref2',
                'Debit(FC)',
                'Credit(FC)',
                'Debit',
                'Credit',
                'ValueDate',
                'OCRCode2'
            ],
        ];
    }
    public function map($filas): array
    {
        return [
            '1',
            $this->handleContar(),
            $this->AccountCode($filas->id,$this->state,$filas->TIPO),
            $this->ShortName($filas->id,$this->state,$filas->TIPO),
            $this->Reference1($filas->id,$this->state,$filas->TIPO,$filas->DESCRIPCION),
            '',
            '',
            '',
            $this->Debit($filas->id,$this->state,$filas->TIPO,$filas->IMPORTE_PAGADO),
            $this->Credit($filas->id),
            $this->DueDate($filas->id,$filas->FECHA_GASTO),
            $this->CostingCode2($filas->id,$filas->CENTRO_COSTOS_ID,$this->solicitud_id)
        ];
    }
    public function CostingCode2($id,$centro_costos_id,$solicitud_id){
        if($id=='97483647'){
            $rendicion=RendicionSolicitud::where('id',$solicitud_id)->first();
            $centro_costos=CentroCostos::where('id',$rendicion->CENTRO_COSTOS_ID)->first();
            return $centro_costos->COD_SAP;
        }else{
            $centro_costos=CentroCostos::where('id',$centro_costos_id)->first();
            return $centro_costos->COD_SAP;
        }
    }
    public function DueDate($id,$fecha_gasto){
        if($id=='97483647'){
            return '';
        }else{
            $date=explode("/",str_replace('-','/', $fecha_gasto));
            return $date[2].$date[1].$date[0];
        }
    }
    public function Credit($id){
        if($id=='97483647'){
            return $this->Total();
        }else{
           return '';
        }
    }
    public function Debit($id,$state,$tipo,$importe_pagado){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return $importe_pagado;
            }else{
                if($state=='par'){
                    return $importe_pagado-($importe_pagado*0.13);
                }else{
                    return $importe_pagado*0.13;
                }
            }
        }
    }
    public function Reference1($id,$state,$tipo,$descripcion){
        if($id=='97483647'){
            return 'CAJA CHICA DISTRIBUCION - LP'; // a cambiar segun usuario
        }else{
            if($tipo=='Sin IVA'){
                return $descripcion;
            }else{
                if($state=='par'){
                    return $descripcion;
                }else{
                    return 'CRÉDITO FISCAL - IVA';
                }
            }
        }
    }
    public function ShortName($id,$state,$tipo){
        if($id=='97483647'){
            return ''; 
        }else{
            if($tipo=='Sin IVA'){
                return $this->handlegetCodigoUsuario();
            }else{
                if($state=='par'){
                    return $this->handlegetCodigoUsuario();
                }else{
                    return '';
                }
            }
        }
    }
    public function AccountCode($id,$state,$tipo){
        if($id=='97483647'){
            return '_SYS00000000175';  // a cambiar segun usuario
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return '_SYS00000000220';
                }
            }
        }
    }
    public function query()
    {
        $vacios=CamposVaciosRendicion::query();
        $facturas=RendicionViaticosDetalle::query()->where('RENDICION_VIATICOS_ID',$this->solicitud_id)->where('TIPO',"Con IVA");
        $facturas2=RendicionViaticosDetalle::query()->where('RENDICION_VIATICOS_ID',$this->solicitud_id)->where('TIPO',"Con IVA")
                                        ->unionAll($facturas);
        $recibos=RendicionViaticosDetalle::query()->where('RENDICION_VIATICOS_ID',$this->solicitud_id)->where('TIPO',"Sin IVA")
                                        ->unionAll($facturas2);
        return $recibos->unionAll($vacios)->orderBy('TIPO','ASC')->orderBy('id','ASC');;  
    }
    public function handleContar(){
      $this->index++;
      if ($this->index%2==0)
      { $this->state='par'; } //escribo Par
      else //Sino
      { $this->state='impar'; }
      return $this->index==0?'0':$this->index;
    }
    public function handlegetCodigoUsuario(){
      $rendicion=RendicionSolicitud::where('id',$this->solicitud_id)->first();
      $usuario=User::where('id',$rendicion->SOLICITADO_ID)->first();
      $codigo=DB::table('Codigo_Usuario')->select('Codigo_Usuario.CardCode')->where('Codigo_Usuario.LicTradNum',$usuario->ci)->first();
      if(isset($codigo->CardCode)){
        return $codigo->CardCode;
      }else{
        return "No existe el usuario";
      }
    }
    public function Total(){
        $rendicion= DB::table('TOTAL_RENDICION_DETALLE')->where('RENDICION_VIATICOS_ID',$this->solicitud_id)->first();
        return $rendicion->Total;
    }
}
