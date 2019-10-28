<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hana\SQL\Almacen;
use App\Exports\DatosAlmacenExport;
use Excel;
class controllerAlmacen extends Controller
{
    public $Almacen;
    public function __construct(){
      $this->Almacen=new Almacen();
    }
    public function handleGetArticulos(Request $request){
      return $this->Almacen->ArticulosStock($request->sucursal_id);
    }
    public function handleGetFabricantes(Request $request){
      return $this->Almacen->Fabricantes($request);
    }
    public function handleGetUsuarios($lista_id){
      return $this->Almacen->Usuarios($lista_id);
    }
    public function handleStoreLista(Request $request){
      $this->Almacen->StoreLista($request);
    }
    public function handleGetListas(Request $request){
      return $this->Almacen->Listas($request->usuario_id);
    }
    public function handleDeleteLista($id){
      $this->Almacen->DeleteLista($id);
    }
    public function handleUpdateLista(Request $request){
      $this->Almacen->UpdateLista($request);
    }
    public function handleStoreAsignacion(Request $request){
      $this->Almacen->StoreAsignacion($request);
      $this->Almacen->StoreFabricante($request);
    }
    public function handleGetAsignacion($lista_id){
      return $this->Almacen->Asignaciones($lista_id);
    }
    public function handleDeleteFabricante($id){
      $this->Almacen->DeleteFabricante($id);
    }
    public function handleDeleteAsignacion($id){
      $this->Almacen->DeleteAsignacion($id);
    }
    public function handleGetEditFabricantes(Request $request){
      return $this->Almacen->EditFabricantes($request);
    }
    public function handleUpdateAsignacion(Request $request){
      return $this->Almacen->UpdateAsignacion($request);
    }
    public function handleExportArticulos(Request $request){
      return Excel::download(new DatosAlmacenExport, 'Almacen.xlsx');
    }
}
