<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Solicitud;
use Auth;
use Mail;
use App\DetalleSolicitud;
use Illuminate\Support\Facades\DB;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArticulosExport;
use Spatie\ArrayToXml\ArrayToXml;
use Storage;
use Carbon\Carbon;
class controllerABMSolicitud extends Controller
{
    public function xml($url)
    {
        return $archivo="
        <Transfer>
            <Logon>
                <UserName>sist_lp1</UserName>
                <Password>TJiLkKvLkLrDrEuBsC</Password>
                <Company>LEVCORP_PRUEBA</Company>
                <Server>saphana:30015</Server>
                <UserAuthentication>False</UserAuthentication>
                <Language />
                <LicenseServer>
                </LicenseServer>
                <ChooseDB>True</ChooseDB>
                <DBType>9</DBType>
                <DBUser>
                </DBUser>
                <SybasePort />
                <DBPassword>
                </DBPassword>
            </Logon>
        <ObjectCode>oItems</ObjectCode>
        <FileExtractor>
          <Extorlogin>
            <ExID />
            <ExPW />
            <ExDSN />
            <ExDB />
            <ExbHANA />
            <ExbSSL />
          </Extorlogin>
          <FilesTypes>1</FilesTypes>
          <Files>
            <Items>".$url."</Items>
          </Files>
        </FileExtractor>
        <Map>
          <Fields>
            <Items>
              <SourceFields>
                <RecordKey />
                <ItemCode />
                <ItemName />
                <Manufacturer />
                <Mainsupplier />
                <Series />
                <InventoryUOM />
                <U_Cod_Vent />
                <U_Cod_comp />
                <U_Codigo_BR />
                <U_FAMILIA />
                <U_SUBFAMILIA />
                <User_Text />
              </SourceFields>
              <TargetFields>
                <RecordKey>RecordKey</RecordKey>
                <ItemCode>ItemCode</ItemCode>
                <ItemName>ItemName</ItemName>
                <Manufacturer>Manufacturer</Manufacturer>
                <Mainsupplier>Mainsupplier</Mainsupplier>
                <Series>Series</Series>
                <InventoryUOM>InventoryUOM</InventoryUOM>
                <U_Cod_Vent>U_Cod_Vent</U_Cod_Vent>
                <U_Cod_comp>U_Cod_comp</U_Cod_comp>
                <U_Codigo_BR>U_Codigo_BR</U_Codigo_BR>
                <U_FAMILIA>U_FAMILIA</U_FAMILIA>
                <U_SUBFAMILIA>U_SUBFAMILIA</U_SUBFAMILIA>
                <User_Text>User_Text</User_Text>
              </TargetFields>
            </Items>
          </Fields>
        </Map>
        <Run>
          <Import>1</Import>
          <Rollback>False</Rollback>
          <MaxError>10</MaxError>
          <Update>0</Update>
          <TestRun>0</TestRun>
          <AddAllItems>Checked</AddAllItems>
          <LineData>0</LineData>
          <DataType>1</DataType>
          <MultiThread>False</MultiThread>
          <ThreadNum>4</ThreadNum>
        </Run>
    </Transfer>";
    }
    public function fecha()
    {
        $fecha=Carbon::now();
        return $fecha->format('Y-m-d-H-m-s');
    }
    public function show($id)
    {
        $solicitud=Solicitud::where('id',$id)->first();
        $estado=$solicitud->estado;
        return response()->json($estado);
    }
    public function exportCSV($nombre,$apellido,$id,$fecha)
    {           
        $usuario=strtolower(substr($nombre,0,1).$apellido);       
        $nombre=$usuario."\articulo\\".$fecha.'.csv';
        $url=base_path()."\public\archivos\usuarios\\".$nombre;
        Excel::store(new ArticulosExport($id), $nombre, 'usuarios', \Maatwebsite\Excel\Excel::CSV);
        $xml=$this->xml($url);
        Storage::disk('usuarios')->put($usuario.'\script.xml', $xml);
        shell_exec('"C:\Program Files (x86)\SAP\Data Transfer Workbench\DTW.exe" -s C:\laragon\www\Levcorp\public\archivos\usuarios\\'.$usuario.'\script.xml');
    }
    public function numero()
    {
        $numero=Solicitud::all();
        $numero->last();
        return response()->json($numero->last()->numero+1);
    }
    public function datos($paginacion,$tipo)
    {
        $solicitudes=Solicitud::where('estado',ucfirst($tipo))->orderBy('id','desc')->with('usuario')->paginate($paginacion);
        return response()->json($solicitudes);
    }
    public function sendMail($id,$fecha)
    {
        Solicitud::findOrFail($id)->fill(['estado'=>'Realizado'])->save();
        $asunto='Articulos ABM';
        $usuario=User::findOrFail(Solicitud::findOrFail($id)->usuario_id);
        $para =['sistemas@levcorp.bo',$usuario->email];
        $articulos=DetalleSolicitud::where('solicitud_id',$id)->orderBy('id','desc')->get();
        $this->exportCSV($usuario->nombre,$usuario->apellido,$id,$fecha);
        Mail::send('mails.articulosABM',['articulos' => $articulos,'usuario'=>$usuario],function($mensaje) use($para,$asunto){
            $mensaje->from('admin@levcorp.bo','Sistemas');
            $mensaje->to($para);
            $mensaje->subject($asunto);
        });     
    }
    public function index()
    {
        $articulos=DetalleSolicitud::where('solicitud_id',1)->orderBy('id','desc')->get();
        $solicitudesR=Solicitud::where('estado','Realizado')->orderBy('id','desc')->paginate(10);
        $solicitudesP=Solicitud::where('estado','Pendiente')->orderBy('id','desc')->paginate(10);
        return view('panel.abm.index',compact('solicitudesR','solicitudesP'));
    }
    public function store(Request $request)
    {
        Solicitud::create([
            'numero'=>$request->numero,
            'usuario_id'=>$request->usuario_id,
            //fecha de solicitud
            'fecha'=>$request->fecha,
            //Estado de la solicitud
            'estado'=>'Pendiente'
        ]);
    }
    public function destroy($id)
    {
        $detalles=DetalleSolicitud::select('id')->where('solicitud_id',$id)->get()->toArray();
        DetalleSolicitud::destroy($detalles);
        Solicitud::findOrFail($id)->delete();
    }
}
