<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hana\SQL\Almacen;
use App\Exports\AlmacenExport;
use Excel;
use DB;
class controllerAlmacenUsuario extends Controller
{
    public $Almacen;
    public function __construct(){
      $this->Almacen=new Almacen();
    }
    public function handleGetListas($usuario_id){
      return $this->Almacen->GetUsuarioListas($usuario_id);
    }
    public function handleGetFabricantes(Request $request){
      return $this->Almacen->GetFabricantesAsignados($request);
    }
    public function handleGetArticulos(Request $request){
      return $this->Almacen->GetArticulos($request);
    }
    public function handleStoreArticulos(Request $request){
      return $this->Almacen->StoreArticulos($request);
    }
    public function handleGetArticulosCheck(Request $request){
      return $this->Almacen->GetArticulosCheck($request);
    }
    public function handleExportLista(Request $request){
      return Excel::download(new AlmacenExport($request->LISTA_ID,$request->USUARIO_ID), 'Almacen.xlsx');
    }
    public function Lista(){
      return DB::table('LISTA_ALMACEN')
      ->select('users.nombre','users.apellido','FABRICANTE_ASIGNACION.FABRICANTE','ARTICULOS_ALMACEN.ItemCode','ARTICULOS_ALMACEN.COD_VENTA','ARTICULOS_ALMACEN.ITEMNAME','ARTICULOS_ALMACEN.UBICACION','ARTICULOS_ALMACEN.ONHAND','ARTICULOS_ALMACEN.ALMACEN','ARTICULOS_ALMACEN.OBSERVACION')
      ->join('ASIGNACION_ALMACEN','LISTA_ALMACEN.id','=','ASIGNACION_ALMACEN.LISTA_ID')
      ->join('FABRICANTE_ASIGNACION','FABRICANTE_ASIGNACION.ASIGNACION_ID','=','ASIGNACION_ALMACEN.id')
      ->join('ARTICULOS_ALMACEN','ARTICULOS_ALMACEN.FABRICANTE_ASIGNACION_ID','=','FABRICANTE_ASIGNACION.id')
      ->join('users','users.id','=','ASIGNACION_ALMACEN.USUARIO_ID')
      ->where('ASIGNACION_ALMACEN.USUARIO_ID','=','1')->where('LISTA_ALMACEN.id','=','2')->get();
    }
}
