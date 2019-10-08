<?php

namespace App\Exports;

use App\ArticulosUbicacion;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UbicacionesExport implements FromQuery, WithMapping,WithHeadings
{
    use Exportable;
    private $lista_id;
    public function __construct(int $lista_id)
    {
        $this->lista_id = $lista_id;
    }
    public function query()
    {
        return ArticulosUbicacion::query()->where('LISTA_ID',$this->lista_id);
    }
    public function headings(): array
    {
        return [
                [
                    'ParentKey',
                    'LineNum',
                    'U_UbicFis',
                ],
                [
                    'ItemCode',
                    'LineNum',
                    'U_UbicFis',
                ]
            ];
    }
    public function map($articulo): array
    {
        return [
            $articulo->ITEMCODE,
            $articulo->COD_ALMACEN,
            $articulo->UBICACION_FISICA
        ];
    }
}
