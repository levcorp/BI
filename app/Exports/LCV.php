<?php

namespace App\Exports;

use App\Transacciones_Levcoins;
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
class LCV implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
    use Exportable;
    public $index;
    public function __construct(){
      $this->index = 0;
    }
    public function headings(): array
    {
        return [
          '#',
          'EMISOR',
          'BENEFICIARIO',
          'MONTO',
          'MOTIVO',
          'OPCION MOTIVO',
          'FECHA'
        ];
    }
    public function map($data): array
    {
        return [
          $this->handleContar(),
          $data->emisor->nombre.' '.$data->emisor->apellido,
          $data->beneficiario->nombre.' '.$data->beneficiario->apellido,
          $data->MONTO,
          $data->MOTIVO,
          $data->OPCION_MOTIVO,
          $data->FECHA
        ];
    }
    public function handleContar(){
      return $this->index++;
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $count=(int)Transacciones_Levcoins::count()+1;
                $color='4F81BD';
                $cellRange = 'A1:G1';
                $event->sheet->getStyle($cellRange)
                             ->getFont()
                             ->setSize(12)
                             ->setBold(true)
                             ->getColor()
                             ->setARGB('FFFFFF');
                $event->sheet->getStyle('A2:G'.$count)
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
    public function collection(){
        return Transacciones_Levcoins::with('beneficiario','emisor')->orderBy('id','desc')->get();
    }
}
