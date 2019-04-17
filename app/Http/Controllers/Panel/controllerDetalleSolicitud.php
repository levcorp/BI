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
class controllerDetalleSolicitud extends Controller
{
    public function __construct()
    {
      $this->middleware('panel',['only'=>'show']);
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
    public function detalles($id,$paginacion)
    {
        return response()->json(Detalle::where('solicitud_id',$id)->orderBy('id','desc')->paginate($paginacion));
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
            case "BELDEN":
                return  "186";
            break;
            case "ENDRESS+HAUSER":
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
        $local=Detalle::select('cod_venta')->where('solicitud_id',Solicitud::where('estado','Pendiente')->first()->id)->get();
        $codVenta=array();
        foreach($datos as $dato)
        {
            array_push($codVenta,$dato->U_Cod_Vent);
           
        }
        foreach($local as $dato)
        {
            array_push($codVenta,$dato->cod_venta);
        }
        return $codVenta;
    }
    public function codComp(){
        $datos=OITM::select('U_Cod_comp')->get();
        $local=Detalle::select('cod_compra')->where('solicitud_id',Solicitud::where('estado','Pendiente')->first()->id)->get();
        $codComp=array();
        foreach($datos as $dato)
        {
            array_push($codComp,$dato->U_Cod_comp);
        }
        foreach($local as $dato)
        {
            array_push($codComp,$dato->cod_compra);            
        }
        return $codComp;
    }
    public function prefijo($cod_fabricante,$cod_compra){
        $prefijo=Prefijo::where('FirmCode',$cod_fabricante)->where('PREFIJO','!=',null)->first();        
        return $prefijo->PREFIJO.$cod_compra;
    } 
}
