<?php

namespace App\Exports;

use App\Historial_Registros;
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

class HistorialAsistencia implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
    use Exportable;
    protected $fecha1;
    protected $fecha2;
    public function __construct(string $fecha1, string $fecha2)
    {
      $this->fecha1 = $fecha1;
      $this->fecha2 = $fecha2;
      return  $this;
    }
    public function headings(): array
    {
        return [
          'Nombre',
          'Apellido',
          'Fecha',
          'Hora',
          'Tipo',
          'Lugar',
          'Ciudad'
        ];
    }
    public function map($data): array
    {
        return [
          $data->usuario->nombre,
          $data->usuario->apellido,
          $data->fecha,
          $data->hora,
          $this->StringTipo($data->tipo),
          $this->StringLugar($data->ip),
          $data->usuario->ciudad,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $count=(int)Historial_Registros::whereDate('fecha','>=',$this->fecha1)
                  ->whereDate('fecha','<=',$this->fecha2)->count()+1;
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
        return Historial_Registros::whereDate('fecha','>=',$this->fecha1)
          ->whereDate('fecha','<=',$this->fecha2)
          ->with('usuario')
          ->get();
    }
    public function StringTipo($tipo){
      switch ($tipo) {
        case 'E':
          return 'Entrada';
        break;
        case 'A':
          return 'Almuerzo';
        break;
        case 'R':
          return 'Regreso';
        break;
        case 'S':
          return 'Salida';
        break;
      }
    }
    public function StringLugar($ip){
      switch ($ip) {
        case '190.181.41.234':
          return 'Oficina';
        break;
        case '190.181.41.235':
          return 'Oficina';
        break;
        default:
          return 'Hogar';
        break;
      }
    }
}
