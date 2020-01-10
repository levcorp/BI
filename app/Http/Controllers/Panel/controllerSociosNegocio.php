<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hana\SQL\Socio;
use App\SocioNegocio;
use Response;
use Carbon;
use App\User;
class controllerSociosNegocio extends Controller
{
    protected $socio;
    public function __construct(){
        $this->socio=new Socio();
    }
    public function handleStoreSocio(Request $request){
        SocioNegocio::create([
            'LISTA_ID'=>$request->lista_id,
            'RAZON_SOCIAL' => $request->razon_social,
            'NOMBRE_EMPRESA'=>$request->nombre_empresa,
            'NIT'=>$request->nit,
            'SUCURSAL'=>$request->sucursal,
            'CIUDAD'=>$request->ciudad,
            'DIRECCION'=>$request->direccion,
            'TELEFONO'=>$request->telefono,
            'FAX'=>$request->fax,
            'WEB'=>$request->web,
            'PERSONA_CONTACTO'=>$request->persona_contacto,
            'MAIL'=>$request->mail,
            'CELULAR'=>$request->celular
        ]);
    }
    public function handleDeleteSocio($id){

    }
    public function handleGetGrupos(){
        return $this->socio->getGrupos();
    }
}

