<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetalleSolicitud as Detalle;
use App\Fabricante;
use App\Especialidad;
use App\Proveedor;
use App\EspecialidadMeses as FYS;
use Illuminate\Support\Facades\DB;
use Session;
class controllerDetalleSolicitud extends Controller
{
    public function __construct()
    {
        if(Session::has('id')){Session::put($id);}
    }
    public function datos($opcion)
    {
        switch($opcion)
        {
            case "fabricante":
                return response()->json(Fabricantes::all());
            break;
            case "especialida":
                return response()->json(Especialidad::all());
            break;
            case "proveedores":
                return response()->json(Proveedor::select('CardName','CardCode')->get());
            break;
            case "id":
                return response()->json(Session::get('id'));
            break;
        }
    }
    public function detalles($paginacion)
    {
        return response()->json(Detalle::where('solicitud_id',Session::get('id'))->orderBy('id','desc')->paginate($paginacion));
    }
    public function index(){   
        //dd(FYS::all());
        return view('panel.abm.detalle');
    }
    public function store(Request $request){
        Detalle::create([
            'serie'=>$request->serie,
            'fabricante'=>$request->fabricante,
            'cod_fabricante'=>$cod_fabricante,
            'proveedor'=>$request->proveedores,
            'cod_proveedor'=>$request->cod_proveedor,
            'especialidad'=>$request->especialidad,
            'cod_especialidad'=>$cod_especialidad,
            'familia'=>$request->familia,
            'subfamilia'=>$request->subfamilia,
            'medida'=>$request->medida,
            'cod_venta'=>$request->cod_venta,
            'cod_compra'=>$request->cod_compra,
            'descripcion'=>$request->descripcion,
            'comentarios'=>$request->comentarios
        ]);
    }   
    public function show($id)
    {
        Session::put('id',$id);
        return view('panel.abm.detalle');    
    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id){
        Detalle:findOrFail($id)->delete();
    }
}
