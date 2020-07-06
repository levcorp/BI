<?php
namespace App\Exports;
use App\DetalleSolicitud as Articulos;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\RendicionSolicitud;
use Carbon\Carbon;
use App\User;
use DB;
class AsientoContableCabezera implements FromQuery, WithMapping,WithHeadings
{
    use Exportable;
    public $rendicion_id;
    public function __construct(int $rendicion_id)
    {
        $this->rendicion_id = $rendicion_id;
    }
    public function headings(): array
    {
        return [
            [
                'Recordkey',
                'Reference',
                'Reference2',
                'Memo',
                'U_GLOSAM',
                'RefDate',
            ],
            [
                'Recordkey',
                'Reference1',
                'Reference2',
                'Details',
                'Glosa',
                'ReferenceDate1',
            ],
        ];
    }
    public function map($rendicion): array
    {
        return [
            '1',
            $this->handlegetCodigoUsuario($rendicion->SOLICITADO_ID),
            '',
            $rendicion->DESCRIPCION,
            $rendicion->MOTIVO,
            $rendicion->FECHA_AUTORIZACION
        ];
    }
    public function query()
    {
        return RendicionSolicitud::query()->where('id',$this->rendicion_id);
    }
    public function handlegetCodigoUsuario($usuario_id){
      $usuario=User::where('id',$usuario_id)->first();
      $codigo=DB::table('Codigo_Usuario')->select('Codigo_Usuario.CardCode')->where('Codigo_Usuario.LicTradNum',$usuario->ci)->first();
      if(isset($codigo->CardCode)){
        return $codigo->CardCode;
      }else{
        return "No existe el usuario";
      }
    }
}
