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
    public function handleGetDatos($sucursal){
        return $this->query->getDatos($sucursal);
    }
    public function handleGetDetalle(Request $request){
        return $this->query->getDetalle($request);
    }
    public function handleExport($sucursal){
        return Excel::download(new SeguimientoExport($sucursal),'export.xlsx');
    }
}   