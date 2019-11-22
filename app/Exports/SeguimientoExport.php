<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Hana\SQL\Seguimiento;
class SeguimientoExport implements FromView
{
    public $query;

    public function __construct(){
        $this->query=new Seguimiento();
    }
    public function view(): View
    {
        $datos=$this->query->getAll();
        return view('exports.datosSeguimientoExport', compact('datos'));
    }
}
