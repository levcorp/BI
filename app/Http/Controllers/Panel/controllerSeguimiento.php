<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hana\SQL\Seguimiento;
use App\Exports\SeguimientoExport;
use Response;
use Excel;
class controllerSeguimiento extends Controller
{
    public $query;
    public function __construct(){
        $this->query=new Seguimiento();
    }
    public function handleGetDatos(){
        return $this->query->getDatos();
    }
    public function handleGetDetalle($DocNum){
        return $this->query->getDetalle($DocNum);
    }
    public function handleExport(){
        return Excel::download(new SeguimientoExport(),'export.xlsx');
    }
}   