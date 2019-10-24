<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hana\SQL\Almacen;

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
}
