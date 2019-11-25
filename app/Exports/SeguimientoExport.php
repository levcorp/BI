<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Hana\SQL\Seguimiento;
class SeguimientoExport implements FromView
{
    public $query;
    public $sucursal;
    public function __construct($sucursal){
        $this->query=new Seguimiento();
        $this->sucursal=$sucursal;
    }
    public function view(): View
    {
        $datos=$this->query->getAll($this->sucursal);
        return view('exports.datosSeguimientoExport', compact('datos'));
    }
    
}
