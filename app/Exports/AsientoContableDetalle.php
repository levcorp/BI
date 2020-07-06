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
            $this->state=='par'?'':'_SYS00000000220',
            $this->state=='par'?$this->handlegetCodigoUsuario():'',
            $this->state=='par'?$filas->DESCRIPCION:'CRÉDITO FISCAL - IVA',
            '',
            '',
            $filas->IMPORTE_PAGADO-$filas->IMPORTE_PAGADO*0.13,
            $filas->IMPORTE_PAGADO*0.13,
            '',
            $filas->FECHA_GASTO,
            'COM'
        ];
    }
    public function query()
    {
        $vacios=CamposVaciosRendicion::query();
        $rendicion=RendicionViaticosDetalle::query()->where('RENDICION_VIATICOS_ID',$this->solicitud_id);
        $rendicion2=RendicionViaticosDetalle::query()->where('RENDICION_VIATICOS_ID',$this->solicitud_id)
                                        ->unionAll($rendicion)
                                        ->orderBy('id');
        return $rendicion2->unionAll($vacios);

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
}
