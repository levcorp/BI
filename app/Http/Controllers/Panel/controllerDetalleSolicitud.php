<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DetalleSolicitud as Detalle;
use App\Fabricante;
use App\Especialidad;
use App\Proveedor;
use App\EspecialidadMeses as FYS;
use App\Familia;
use Illuminate\Support\Facades\DB;
use Session;
use Validator;
use App\OITM;
use App\Http\Requests\RequestArticulosABM as RArticulos;
use App\Prefijo;
use App\Solicitud;
use Response;
class controllerDetalleSolicitud extends Controller
{
    public function __construct()
    {
        $this->middleware('Check',['only'=>'show']);
        $this->middleware('ArticulosABM',['only'=>'show']);        
    }
    public function index()
    {
      return $this->codigo(1);
    }
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
                return response()->json(Familia::select('Familia')
                                        ->where('Especialidad','like',$especialidad)
                                        ->where('Marca','like',$fabricante)
                                        ->groupBy('Familia')->get());
            break;
            case "subfamilias":
                return response()->json(
                    Familia::select('Subfamilia')
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
    //new GET
    public function proveedores(Request $request){
        return Response::json(Proveedor::select('CardName','CardCode')->where('CardName','like',$request->value.'%')->get());
    }
    //new GET
    public function fabricantes(Request $request){
        return Response::json(Fabricante::where('FirmName','like',$request->value.'%')->get());
    }
    //new GET
    public function detalles($id,$paginacion){
        return response()->json(Detalle::where('solicitud_id',$id)->orderBy('id','desc')->paginate($paginacion));
    }
    //new get
    public function items(Request $request){
        return response()->json(Detalle::where('solicitud_id',$request->solicitud_id)->orderBy('id','desc')->get());
    }
    public function codigo($cod_fabricante,$cod_proveedor){
        if ($cod_proveedor=="PE-0010046") {
            $codigo=DB::select('Select dbo.ULTIMO_CODIGO_IN('.$cod_fabricante.') as Codigo');            
        }else{
            $codigo=DB::select('Select dbo.ULTIMO_CODIGO('.$cod_fabricante.') as Codigo');
        }
        $parte=json_encode($codigo[0],true);
        $codigo=$parte[11].$parte[12].$parte[13].$parte[14].$parte[15].$parte[16].$parte[17].$parte[18].$parte[19];
        $separar=explode("-",$codigo);
        $base=$separar[0];
        $numero=$separar[1];
        $suma =(int) $numero+1;
        $vector=str_split((string)$suma);
        $contar=count($vector);
        $ceros=5-$contar;
        $addcero='';
        for($i=1;$i<=$ceros;$i++)
        {
            $addcero=$addcero."0";
        }
        $newcodigo=$base."-".$addcero.(string)$suma;
        return $newcodigo;
    }
    public function serie($serie){
        switch($serie)
        {
            case "Belden":
                return  "186";
            break;
            case "Endress+Hauser":
                return "183";
            break;
            case "Festo":
                return "182";
            break;
            case "Kaeser" :
                return "184";
            break;
            case "Manual":
                return  "3";
            break;
            case "Rockwell Automation":
                return "181";
            break;
            case "Yale":
                return "185";
            break;          
        }
    }
    public function store(RArticulos $request){
        Detalle::create([
            'serie'=>$this->serie($request->serie),
            'cod_item'=>$this->codigo($request->cod_fabricante,$request->cod_proveedor),
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
            'cod_compra'=>$this->prefijo($request->cod_fabricante,$request->cod_compra),
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
    public function codVent(){
        $datos=OITM::select('U_Cod_Vent')->get();
        $solictudes=Solicitud::select('id')->where('estado','Pendiente')->get();
        $id=array(); 
        foreach($solictudes as $solicitud){
            array_push($id,$solicitud->id);
        }
        $local=Detalle::select('cod_venta')->whereIn('solicitud_id',$id)->get();
        $codVenta=array();
        foreach($datos as $dato){
            array_push($codVenta,$dato->U_Cod_Vent);
        }
        foreach($local as $dato){
            array_push($codVenta,$dato->cod_venta);
        }
        return $codVenta;
    }
    //new COd
    public function cVenta(Request $request){
        $count=OITM::select('U_Cod_Vent')->where('U_Cod_Vent',$request->value)->count();
        $count+=DB::table('detalle_solicituds')->select('cod_venta')
                ->join('solicituds','solicituds.id','=','detalle_solicituds.solicitud_id')
                ->where('detalle_solicituds.cod_venta',$request->value)->where('solicituds.estado','Pendiente')->count();
        if($count>0){return 1;}else{ return 0;}
    }
    //new COd
    public function cCompra(Request $request){
        $count=OITM::select('U_Cod_comp')->where('U_Cod_comp',$request->value)->count();
        $count+=DB::table('detalle_solicituds')->select('cod_compra')
                ->join('solicituds','solicituds.id','=','detalle_solicituds.solicitud_id')
                ->where('detalle_solicituds.cod_compra',$request->value)->where('solicituds.estado','Pendiente')->count();
        if($count>0){return 1;}else{ return 0;}
    }
    public function codComp(){
        $datos=OITM::select('U_Cod_comp')->get();
        $solictudes=Solicitud::select('id')->where('estado','Pendiente')->get();
        $id=array(); 
        foreach($solictudes as $solicitud){
            array_push($id,$solicitud->id);
        }
        $local=Detalle::select('cod_compra')->whereIn('solicitud_id',$id)->get();        
        $codComp=array();
        foreach($datos as $dato){
            array_push($codComp,$dato->U_Cod_comp);
        }
        foreach($local as $dato){
            array_push($codComp,$dato->cod_compra);            
        }
        return $codComp;
    }
    public function prefijo($cod_fabricante,$cod_compra){
        $prefijo=Prefijo::where('FirmCode',$cod_fabricante)->where('PREFIJO','!=',null)->first();        
        return $prefijo->PREFIJO.$cod_compra;
    } 
    //new store Item
    public function storeItem(Request $request ){
        $cFabricante=$this->cFabricante($request->fabricante);
        $cProveedor=$this->cProveedor($request->proveedor);
        $especialidad=$this->especialidad($request->cod_especialidad);
        Detalle::create([
            'serie'=>$this->serie($request->serie),
            'cod_item'=>$this->codigo($cFabricante->FirmCode,$cProveedor->CardCode),
            'fabricante'=>$request->fabricante,
            'cod_fabricante'=>$cFabricante->FirmCode,
            'proveedor'=>$request->proveedor,
            'cod_proveedor'=>$cProveedor->CardCode,
            'especialidad'=>$especialidad->Descripcion,
            'cod_especialidad'=>$request->cod_especialidad,
            'familia'=>$request->familia,
            'subfamilia'=>$request->subfamilia,
            'medida'=>$request->medida,
            'cod_venta'=>$request->cod_venta,
            'cod_compra'=>$this->prefijo($cFabricante->FirmCode,$request->cod_compra),
            'descripcion'=>$this->cadena($request->descripcion),
            'comentarios'=>$this->cadena($request->comentarios),
            'solicitud_id'=>$request->solicitud_id,
            'upc'=>$request->upc
        ]);
    }
    public function cFabricante($fabricante){
        return Fabricante::select('FirmCode')->where('FirmName','like',$fabricante)->first();
    }
    public function cProveedor($proveedor){
        return Proveedor::select('CardCode')->where('CardName','like',$proveedor)->first();
    }
    public function especialidad($cEspecialidad){
        return Especialidad::select('Descripcion')->where('Especialidad',$cEspecialidad)->first();
    }
    public function preCod(Request $request){
        $cFabricante=$this->cFabricante($request->fabricante);
        $prefijo=Prefijo::where('FirmCode',$cFabricante->FirmCode)->where('PREFIJO','!=',null)->first();        
        return Response::json($prefijo->PREFIJO);
    } 
    public function cadena($string){
        return str_replace(';','',$string);
    }
}
