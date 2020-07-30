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
    public $fecha;
    public $cuenta;
    public $index;
    public $state;
    public function __construct(int $solicitud_id,string $cuenta, string $fecha)
    {
        $this->solicitud_id = $solicitud_id;
        $this->cuenta=$cuenta;
        $this->index = -1;
        $this->fecha=$fecha;
    }
    public function headings(): array
    {
        return [
            [
                'ParentKey',
                'Line_ID',
                'AccountCode',
                'FCDebit',
                'FCCredit',
                'FCCurrency',
                'DueDate',
                'ShortName',
                'ContraAccount',
                'LineMemo',
                'CostingCode2',
                'U_FechaFac',
                'U_IUE',
                'U_CARDNAME',
                'U_ICE',
                'U_EXENTO',
                'U_Importe',
                'U_TipoDoc',
                'U_CODALFA',
                'U_NUM_FACT',
                'U_NUMORDER',
                'U_NUMPOL',
                'U_RUC',
                'U_TIPOCOM',
                'U_DESCUENTO',
                'U_ESTADOFC'
            ],
            [
                'BatchNum',
                'Line_ID',
                'Account',
                'FCDebit',
                'FCCredit',
                'FCCurrency',
                'DueDate',
                'ShortName',
                'ContraAccount',
                'LineMemo',
                'CostingCode2',
                'Fecha Factura',
                'U_IUE',
                'U_CARDNAME',
                'U_ICE',
                'U_EXENTO',
                'U_Importe',
                'Tipo Documento',
                'Codigo Alfanumerico',
                'Numero Factura',
                'Numero Autorizacion',
                'Numerp de Poliza',
                'nit',
                'Tipo Compra',
                'Descuento Factura',
                'Estado Factura '
            ],
        ];
    }
    public function map($filas): array
    {
        return [
            '1',
            $this->handleContar(),
            $this->AccountCode($filas->id,$this->state,$filas->TIPO),
            $this->FCDebit($filas->id,$this->state,$filas->TIPO,$filas->IMPORTE_PAGADO),
            $this->FCCredit($filas->id),
            $this->FCCurrency(),
            $this->DueDate($this->fecha),
            $this->ShortName($filas->id,$this->state,$filas->TIPO),
            $this->ContraAccount($filas->id,$this->state,$filas->TIPO),
            $this->LineMemo($filas->id,$this->state,$filas->TIPO,$filas->DESCRIPCION),
            $this->CostingCode2($filas->id,$filas->CENTRO_COSTOS_ID,$this->solicitud_id),
            $this->U_FechaFac($filas->id,$filas->FECHA_GASTO),
            $this->U_IUE($filas->id,$filas->TIPO,$this->state),
            $this->U_CARDNAME(),
            $this->U_ICE(),
            $this->U_EXENTO($filas->id,$filas->TIPO,$this->state,$filas->IMPORTE_PAGADO),
            $this->U_Importe($filas->id,$filas->TIPO,$this->state,$filas->IMPORTE_PAGADO),
            $this->U_TipoDoc($filas->id,$filas->TIPO,$this->state),
            $this->U_CODALFA($filas->id,$filas->TIPO,$this->state,$filas->CODIGO_CONTROL),
            $this->U_NUM_FACT($filas->id,$filas->TIPO,$this->state,$filas->N_FACTURA),
            $this->U_NUMORDER($filas->id,$filas->TIPO,$this->state,$filas->NUMERO_AUTORIZACION),
            $this->U_NUMPOL(),
            $this->U_RUC($filas->id,$filas->TIPO,$this->state,$filas->NIT_PROVEEDOR),
            $this->U_TIPOCOM($filas->id,$filas->TIPO,$this->state),
            $this->U_DESCUENTO($filas->id,$filas->TIPO,$this->state,$filas->DESCUENTO),
            $this->U_ESTADOF($filas->id,$filas->TIPO,$this->state)
        ];
    }
    public function U_ESTADOF($id,$tipo,$state){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return 'V';
                }
            }
        }
    }
    public function U_DESCUENTO($id,$tipo,$state,$DESCUENTO){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return $DESCUENTO;
                }
            }
        }
    }
    public function U_TIPOCOM($id,$tipo,$state){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return '1';
                }
            }
        }
    }
    public function U_RUC($id,$tipo,$state,$NIT_PROVEEDOR){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return $NIT_PROVEEDOR;
                }
            }
        };
    }
    public function U_NUMPOL(){
        return '0';
    }
    public function U_NUMORDER($id,$tipo,$state,$NUMERO_AUTORIZACION){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return $NUMERO_AUTORIZACION;
                }
            }
        }
    }
    public function U_NUM_FACT($id,$tipo,$state,$N_FACTURA){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return $N_FACTURA;
                }
            }
        }
    }
    public function U_CODALFA($id,$tipo,$state,$CODIGO_CONTROL){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return $CODIGO_CONTROL;
                }
            }
        }
    }
    public function U_TipoDoc($id,$tipo,$state){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '1';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return '1';
                }
            }
        }
    }
    public function U_Importe($id,$tipo,$state,$IMPORTE_PAGADO){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '0';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return $IMPORTE_PAGADO;
                }
            }
        }
    }
    public function U_EXENTO($id,$tipo,$state,$IMPORTE_PAGADO){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return $IMPORTE_PAGADO;
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return '0';
                }
            }
        }
    }
    public function U_ICE(){
        return '0';
    }
    public function U_CARDNAME(){
      return 'Por definir';
    }
    public function U_IUE($id,$tipo,$state){
        if($id=='97483647'){
            return '';
        }else{
            if($tipo=='Sin IVA'){
                return '';
            }else{
                if($state=='par'){
                    return '';
                }else{
                    return 'S';
                }
            }
        }
    }
    public function ContraAccount($id){
        if($id=='97483647'){
            return $this->cuenta;
        }else{
            return '';
        }
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
    public function DueDate($fecha){
        $date=explode("/",str_replace('-','/', $fecha));
        return $date[2].$date[1].$date[0];
    }
    public function U_FechaFac($id,$fecha_gasto){
        if($id=='97483647'){
            return '';
        }else{
            $date=explode("/",str_replace('-','/', $fecha_gasto));
            return $date[2].$date[1].$date[0];
        }
    }
    public function FCCurrency(){
       return 'BS';
    }
    public function FCCredit($id){
        if($id=='97483647'){
            return $this->Total();
        }else{
           return '';
        }
    }
    public function FCDebit($id,$state,$tipo,$importe_pagado){
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
    public function LineMemo($id,$state,$tipo,$descripcion){
        if($id=='97483647'){
            $cuenta=DB::table('Cuenta_Contable')->where('AcctCode',$this->cuenta)->first();
            return $cuenta->AcctName;
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
            return $this->cuenta;
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
