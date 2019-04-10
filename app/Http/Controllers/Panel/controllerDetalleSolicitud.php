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
use Validator;
use App\Http\Requests\RequestArticulosABM as RArticulos;
class controllerDetalleSolicitud extends Controller
{
    public function datos($opcion,$fabricante=null,$especialidad=null,$familia=null)
    {
        switch($opcion)
        {
            case "fabricantes":
                return response()->json(Fabricante::all());
            break;
            case "especialidades":
                return response()->json(Especialidad::all());
            break;
            case "proveedores":
                return response()->json(Proveedor::select('CardName','CardCode')->get());
            break;
            case "familias":
                return response()->json(FYS::select('Familia')
                                        ->where('Especialidad','like',$especialidad)
                                        ->where('Marca','like',$fabricante)
                                        ->groupBy('Familia')->get());
            break;
            case "subfamilias":
                return response()->json(
                    FYS::select('Subfamilia')
                        ->where('Especialidad','like',$especialidad)
                        ->where('Marca','like',$fabricante)
                        ->where('Familia',$familia)
                        ->groupBy('Subfamilia')->get()
                    );
            break;
            case "id":
                return response()->json($this->id);
            break;
        }
    }
    public function detalles($id,$paginacion)
    {
        return response()->json(Detalle::where('solicitud_id',$id)->orderBy('id','desc')->paginate($paginacion));
    }
    public function index(){   
        //dd(FYS::all());

        return DB::select('EXEC ultimo_codigo 3') ;
    }
    public function serie($serie)
    {
        switch($serie)
        {
            case "BELDEN":
                return  "186";
            break;
            case "ENDRESS + HAUSER":
                return "183";
            break;
            case "FESTO":
                return "182";
            break;
            case "KAESER" :
                return "184";
            break;
            case "MANUAL":
                return  "3";
            break;
            case "ROCKWELL AUTOMATION":
                return "181";
            break;
            case "YALE":
                return "185";
            break;          
        }
    }
    public function store(RArticulos $request)
    {
        Detalle::create([
            'serie'=>$this->serie($request->serie),
            'fabricante'=>$request->fabricante,
            'cod_fabricante'=>$request->cod_fabricante,
            'proveedor'=>$request->proveedor,
            'cod_proveedor'=>$request->cod_proveedor,
            'especialidad'=>$request->especialidad,
            'cod_especialidad'=>$request->cod_especialidad,
            'familia'=>$request->familia,
            'subfamilia'=>$request->subfamilia,
            'medida'=>$request->medida,
            'cod_venta'=>$request->cod_venta,
            'cod_compra'=>$request->cod_compra,
            'descripcion'=>$request->descripcion,
            'comentarios'=>$request->comentarios,
            'solicitud_id'=>$request->solicitud_id,
        ]);
    }
    public function edit($id)   
    {
        return response()->json(Detalle::findOrFail($id));
    }
    public function show($id)
    {
        return view('panel.abm.detalle',compact('id'));    
    }
    public function update(Request $request, $id)
    {
        Detalle::findOrFail($id)->fill([
            'serie'=>$this->serie($request->serie),
            'fabricante'=>$request->fabricante,
            'cod_fabricante'=>$request->cod_fabricante,
            'proveedor'=>$request->proveedor,
            'cod_proveedor'=>$request->cod_proveedor,
            'especialidad'=>$request->especialidad,
            'cod_especialidad'=>$request->cod_especialidad,
            'familia'=>$request->familia,
            'subfamilia'=>$request->subfamilia,
            'medida'=>$request->medida,
            'cod_venta'=>$request->cod_venta,
            'cod_compra'=>$request->cod_compra,
            'descripcion'=>$request->descripcion,
            'comentarios'=>$request->comentarios,
            'solicitud_id'=>$request->solicitud_id,
        ])->save();
    }
    public function destroy($id){
        Detalle::findOrFail($id)->delete();
    }
}
