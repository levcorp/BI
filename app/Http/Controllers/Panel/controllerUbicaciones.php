<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ListaStock;
use Illuminate\Support\Facades\DB;
use Response;
use App\Sucursal;
use App\ArticulosUbicacion;
use App\Exports\UbicacionesExport;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use App\Mail\Ubicaciones\MailArticulos;
use App\User;
use Carbon\Carbon;
use Storage;
class controllerUbicaciones extends Controller
{
    public function getList(Request $request){
        return Response::json(ListaStock::where('ESTADO',$request->estado)->where('USUARIO_ID',$request->usuario_id)->with('usuario')->orderBy('id','asc')->get());
    }
    public function storeList(Request $request)
    {
        ListaStock::create([
            'FECHA_CREACION'=>$request->FECHA_CREACION,
            'FECHA_EJECUCION'=>$request->FECHA_EJECUCION,
            'ESTADO'=>0,
            'USUARIO_ID'=>$request->USUARIO_ID
        ]);
    }
    public function UbicacionesNull(Request $request){
        $sucursal=Sucursal::where('id',$request->WhsCode)->first();
        $ubic='';
        if($sucursal->ciudad=='Santa Cruz'){ $ubic='SCZ001';}
        if($sucursal->ciudad=='La Paz'){ $ubic='LPZ001';}
        if($sucursal->ciudad=='Cochabamba'){ $ubic='CBB001';}
        $codVentas=ArticulosUbicacion::select('COD_VENTA')->where('LISTA_ID',$request->lista_id)->get();
        return Response::json(DB::table('Ubicacion_Null')->where('WhsCode',$ubic)->whereNotIn('U_Cod_Vent',$codVentas)->get());
    }
    public function ChoseUbicacionesNull(Request $request){
        if($request->WhsCode=='Santa Cruz'){ $ubic='SCZ001';}
        if($request->WhsCode=='La Paz'){ $ubic='LPZ001';}
        if($request->WhsCode=='Cochabamba'){ $ubic='CBB001';}
        return Response::json(DB::table('Ubicacion_Null')->where('WhsCode',$ubic)->get());
    }
    public function listaArticulos(Request $request){
        return Response::json(ArticulosUbicacion::where('LISTA_ID',$request->LISTA_ID)->orderBy('id','desc')->get());
    }
    public function handleDeleteList($list_id){
        ArticulosUbicacion::where('LISTA_ID',$list_id)->delete();
        ListaStock::findOrFail($list_id)->delete();
    }
    public function handleSearchCodVenta(Request $request){
       // $sucursal=Sucursal::where('id',$request->ciudad)->first();
        switch ($request->ciudad) {
            case 'La Paz':
                return Response::json(DB::table('UbicacionLPZ')->where('U_Cod_Vent','like',$request->codVenta.'%')->where('WhsCode','like','LPZ001')->get());
                break;
            case 'Cochabamba':
                return Response::json(DB::table('UbicacionCBB')->where('U_Cod_Vent','like',$request->codVenta.'%')->where('WhsCode','like','CBB001')->get());
                break;
            case 'Santa Cruz':
                return Response::json(DB::table('UbicacionSCZ')->where('U_Cod_Vent','like',$request->codVenta.'%')->where('WhsCode','like','SCZ001')->get());
                break;
        }
    }
    public function handleStoreItem(Request $request){
        ArticulosUbicacion::create([
            'ITEMCODE'=>$request->ITEMCODE,
            'COD_VENTA'=>$request->COD_VENTA,
            'COD_COMPRA'=>$request->COD_COMPRA,
            'DESCRIPCION'=>$request->DESCRIPCION,
            'MEDIDA'=>$request->MEDIDA,
            'STOCK'=>$request->STOCK,
            'ALMACEN'=>$request->ALMACEN,
            'COD_ALMACEN'=>$request->COD_ALMACEN,
            //'UBICACION_FISICA'=>$request->UBICACION_FISICA,
            'LISTA_ID'=>$request->LISTA_ID
        ]);
    }
    public function handleDeleteItem($id){
        ArticulosUbicacion::findOrFail($id)->delete();
    }
    public function handleUpdateUbicacion(Request $request){
        ArticulosUbicacion::findOrFail($request->id)->fill([
            'UBICACION_FISICA'=>substr(str_replace(';','',$request->UBICACION_FISICA),0,20)
        ])->save();
    }
    public function handleDeleteUbicacion(Request $request){
        ArticulosUbicacion::findOrFail($request->id)->fill([
            'UBICACION_FISICA'=>null,
        ])->save();
    }
    public function xml($url){
        return $archivo="<Transfer>
        <Logon>
          <UserName>sist_lp1</UserName>
          <Password>SIiLlLvLjMoEmBwDtD</Password>
          <Company>LEVCORP</Company>
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
            <ItemWarehouseInfo>$url</ItemWarehouseInfo>
          </Files>
        </FileExtractor>
        <Map>
          <Fields>
            <ItemWarehouseInfo>
              <SourceFields>
                <RecordKey />
                <ParentKey />
                <LineNum />
                <U_UbicFis />
              </SourceFields>
              <TargetFields>
                <RecordKey>RecordKey</RecordKey>
                <LineNum>LineNum</LineNum>
                <U_UbicFis>U_UbicFis</U_UbicFis>
              </TargetFields>
            </ItemWarehouseInfo>
          </Fields>
        </Map>
        <Run>
          <Import>0</Import>
          <Rollback>False</Rollback>
          <MaxError>10</MaxError>
          <Update>1</Update>
          <TestRun>0</TestRun>
          <AddAllItems>Checked</AddAllItems>
          <LineData>0</LineData>
          <DataType>1</DataType>
          <MultiThread>False</MultiThread>
          <ThreadNum>4</ThreadNum>
        </Run>
      </Transfer>";
    }
    public function handleExport($list_id){
        $user=User::findOrFail(ListaStock::findOrFail($list_id)->USUARIO_ID);
        $usuario=strtolower(substr($user->nombre,0,1).$user->apellido);
        $nombre=$usuario."\articulos\\".Carbon::now()->format('Y-m-dTh-m-s').'.csv';
        $url=base_path()."\public\archivos\ubicaciones\\".$nombre;
        Excel::store(new UbicacionesExport($list_id), $nombre, 'ubicaciones', \Maatwebsite\Excel\Excel::CSV);
        $xml=$this->xml($url);
        Storage::disk('ubicaciones')->put($usuario.'\script.xml', $xml);
        shell_exec('"C:\Program Files (x86)\SAP\Data Transfer Workbench\DTW.exe" -s C:\xampp\htdocs\BI\public\archivos\ubicaciones\\'.$usuario.'\script.xml');
        //shell_exec('"C:\Program Files (x86)\SAP\Data Transfer Workbench\DTW.exe" -s C:\laragon\www\BI\public\archivos\ubicaciones\\'.$usuario.'\script.xml');
    }
    public function handleSend($lista_id){
        ListaStock::findOrFail($lista_id)->fill(['ESTADO'=>1])->save();
        $usuario=User::findOrFail(ListaStock::findOrFail($lista_id)->USUARIO_ID);
        Mail::to($usuario->email)->cc('sistemas@levcorp.bo')->send( new MailArticulos($lista_id,$usuario->id));
        //$this->exportCSV($usuario->nombre,$usuario->apellido,$lista_id,Carbon::now()->format('Y-m-dTh-m-s'));
    }
}
