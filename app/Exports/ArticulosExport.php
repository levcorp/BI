<?php
namespace App\Exports;
use App\DetalleSolicitud as Articulos;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ArticulosExport implements FromQuery, WithMapping,WithHeadings
{
    use Exportable;
    private $solicitud_id;
    public function __construct(int $solicitud_id)
    {
        $this->solicitud_id = $solicitud_id;
    }
    public function headings(): array
    {
        return [
            [
                'ItemCode',
                'ItemName',
                'Manufacturer',
                'Mainsupplier',
                'Series',
                'InventoryUOM',
                'U_Cod_Vent',
                'U_Cod_comp',
                'U_Codigo_BR',
                'U_FAMILIA',
                'U_SUBFAMILIA',
                'User_Text',
                'PurchaseUnit',
                'SalesUnit',
                'PlanningSystem',
                'Properties6'
            ],
            [
                'ItemCode',
                'ItemName',
                'Manufacturer',
                'Mainsupplier',
                'Series',
                'InventoryUOM',
                'U_Cod_Vent',
                'U_Cod_comp',
                'U_Codigo_BR',
                'U_FAMILIA',
                'U_SUBFAMILIA',
                'User_Text',
                'PurchaseUnit',
                'SalesUnit',
                'PlanningSystem',
                'Properties6'
            ],
        ];
    }
    public function map($solicitud): array
    {
        return [
            $solicitud->cod_item,
            $solicitud->descripcion,
            $solicitud->cod_fabricante,
            $solicitud->cod_proveedor,
            $solicitud->serie,
            $solicitud->medida,
            $solicitud->cod_venta,
            $solicitud->cod_compra,
            $solicitud->cod_especialidad,
            $solicitud->familia,
            $solicitud->subfamilia,
            $solicitud->comentarios,
            $solicitud->medida,
            $solicitud->medida,
            "M",
            'Y',
        ];
    }
    public function query()
    {
        return Articulos::query()->where('solicitud_id',$this->solicitud_id);
    }
}