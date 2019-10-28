<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\Exportable;
use App\ArticulosAlmacen;
use App\AsignacionAlmacen;
use App\FabricanteAsignacion;
use App\ListaAlmacen;
use DB;
class AlmacenExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
    use Exportable;
    protected $lista_id;
    protected $usuario_id;
    protected $count;
    public function __construct($lista_id,$usuario_id){
        $this->lista_id=$lista_id;
        $this->usuario_id=$usuario_id;
        $this->count=0;
    }
    public function headings(): array
    {
        return [
            [
                '#',
                'Realizado por',
                'Fabricante',
                'Item Code',
                'Codigo Ventas',
                'Descripción',
                'Ubicación',
                'Cant. Stock',
                'Almacen',
                'Observaciónes'
            ]
        ];
    }
    public function map($item): array
    {
        $this->count++;
        return [
            $this->count,
            $item->nombre." ".$item->apellido,
            $item->FABRICANTE,
            $item->ItemCode,
            $item->COD_VENTA,
            $item->ITEMNAME,
            $item->UBICACION,
            $item->ONHAND,
            $item->ALMACEN,
            $item->OBSERVACION ? $item->OBSERVACION : 'Sin Observaciones'
        ];
    }
    public function collection(){
        return DB::table('LISTA_ALMACEN')
                ->select('users.nombre','users.apellido','FABRICANTE_ASIGNACION.FABRICANTE','ARTICULOS_ALMACEN.ItemCode','ARTICULOS_ALMACEN.COD_VENTA','ARTICULOS_ALMACEN.ITEMNAME','ARTICULOS_ALMACEN.UBICACION','ARTICULOS_ALMACEN.ONHAND','ARTICULOS_ALMACEN.ALMACEN','ARTICULOS_ALMACEN.OBSERVACION')
                ->join('ASIGNACION_ALMACEN','LISTA_ALMACEN.id','=','ASIGNACION_ALMACEN.LISTA_ID')
                ->join('FABRICANTE_ASIGNACION','FABRICANTE_ASIGNACION.ASIGNACION_ID','=','ASIGNACION_ALMACEN.id')
                ->join('ARTICULOS_ALMACEN','ARTICULOS_ALMACEN.FABRICANTE_ASIGNACION_ID','=','FABRICANTE_ASIGNACION.id')
                ->join('users','users.id','=','ASIGNACION_ALMACEN.USUARIO_ID')
                ->where('ASIGNACION_ALMACEN.USUARIO_ID','=',$this->usuario_id)->where('LISTA_ALMACEN.id','=', $this->lista_id)
                ->orderBy('FABRICANTE_ASIGNACION.FABRICANTE','asc')
                ->get();
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $color='4F81BD';
                $cellRange = 'A1:J1';
                $count=$this->count+1;
                $event->sheet->getStyle($cellRange)
                             ->getFont()
                             ->setSize(12)
                             ->setBold(true)
                             ->getColor()
                             ->setARGB('FFFFFF');
                $event->sheet->getStyle('A2:J'.$count)
                             ->getBorders()
                             ->getAllBorders()
                             ->setBorderStyle(Border::BORDER_THIN)
                             ->getColor()
                             ->setARGB($color);
                $event->sheet->getStyle($cellRange)->getFill()
                             ->setFillType(Fill::FILL_SOLID)
                             ->getStartColor()
                             ->setARGB($color);
                $event->sheet->getStyle($cellRange)
                             ->getAlignment()
                             ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}
