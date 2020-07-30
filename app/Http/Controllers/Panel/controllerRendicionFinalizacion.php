<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RendicionSolicitud;
use Response;
use App\RendicionViaticosDetalle;
use DB;
use Excel;
use App\Exports\AsientoContableCabezera;
use App\Exports\AsientoContableDetalle;
use Carbon\Carbon;
use App\User;
use App\Mail\Rendicion\Rendido;
use App\Mail\Rendicion\RechazarRendicion;
use Storage;
use Mail;
class controllerRendicionFinalizacion extends Controller
{
    public function handleGetRendicionFinalizadaNoAutorizada($id){
      return Response::json(RendicionSolicitud::where('ESTADO',4)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->get());
    }
    public function handleGetRendicionFinalizadaAutorizada($id){
      return Response::json(RendicionSolicitud::where('ESTADO',5)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->get());
    }
    public function handleRechazarSolicitud(Request $request){
      //Estado 3 Rendicion Rechazada
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>3,
        'RECHAZO'=>$request->RECHAZO
      ])->save();
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos')->first();
      Mail::send(new RechazarRendicion($request->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,$solicitud->solicitado->email,$solicitud->RECHAZO));
    }
    public function handleRendicionAutorizada(Request $request){
      //Estado 5 Rendicion Autorizada
      RendicionSolicitud::findOrFail($request->id)->fill([
        'ESTADO'=>5
      ])->save();
      $this->SAP($request);
      $solicitud=RendicionSolicitud::where('id',$request->id)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos')->first();
      Mail::send(new Rendido($request->id,$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido,$solicitud->solicitado->email));
    }
    public function handleGetReporteDetalle($id){
      $descargos=RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',$id)->with('centrocostos')->get();
      $solicitud=RendicionSolicitud::where('id',$id)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos')->first();
      $pdf = \PDF::loadView('pdf.rendicion',compact('solicitud','descargos'));
      $pdf->setPaper("letter", "landscape");
      $pdf->getDomPDF()->set_option("enable_php", true);
      return $pdf->download('invoice.pdf');
    }
    public function SAP($request){
      $solicitud=RendicionSolicitud::where('id',$request->id)->first();
      $user=User::where('id',$solicitud->SOLICITADO_ID)->first();
      $fecha=Carbon::now()->format('dmYHms');
      $usuario=strtolower(substr($user->nombre,0,1).$user->apellido);
      $nombreCabeceraSegunda=$usuario.'\cabecera\\'.'SubCabecera'.$fecha.'.csv';
      $nombreDetalle=$usuario.'\detalle\\'.'Detalle'.$fecha.'.csv';
      $urlCabecera=base_path().'\public\archivos\rendicion\CabezeraAsientoContable.csv';
      $urlSubCabecera=base_path().'\public\archivos\rendicion\\'.$nombreCabeceraSegunda;
      $urlDetalle=base_path().'\public\archivos\rendicion\\'.$nombreDetalle;
      Excel::store(new AsientoContableDetalle($solicitud->id,$request->cuenta,$request->fecha), $nombreDetalle, 'rendicion', \Maatwebsite\Excel\Excel::CSV);
      Excel::store(new AsientoContableCabezera($solicitud->id,$request->fecha), $nombreCabeceraSegunda, 'rendicion', \Maatwebsite\Excel\Excel::CSV);
      $xml=$this->xml($urlCabecera,$urlSubCabecera,$urlDetalle);
      Storage::disk('rendicion')->put($usuario.'\script.xml', $xml);
      shell_exec('"C:\Program Files (x86)\SAP\Data Transfer Workbench\DTW.exe" -s C:\xampp\htdocs\BI\public\archivos\rendicion\\'.$usuario.'\script.xml');
    }
    public function xml($urlCabecera,$urlSubCabecera,$urlDetalle){
        return $archivo="<Transfer>
          <Logon>
            <UserName>sist_lp1</UserName>
            <Password>TJjKjNpNmJsAmByFsC</Password>
            <Company>LEVCORP_PRUEBA</Company>
            <Server>saphana:30015</Server>
            <UserAuthentication>False</UserAuthentication>
            <Language />
            <LicenseServer>
            </LicenseServer>
            <ChooseDB>False</ChooseDB>
            <DBType>9</DBType>
            <DBUser>
            </DBUser>
            <SybasePort />
            <DBPassword>
            </DBPassword>
          </Logon>
          <ObjectCode>oJournalVouchers</ObjectCode>
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
            <JournalVouchers>$urlCabecera</JournalVouchers>
            <JournalEntries>$urlSubCabecera</JournalEntries>
            <JournalEntries_Lines>$urlDetalle</JournalEntries_Lines>
            </Files>
          </FileExtractor>
          <Map>
            <Fields>
              <JournalVouchers>
                <SourceFields>
                  <RecordKey />
                </SourceFields>
                <TargetFields>
                  <RecordKey>RecordKey</RecordKey>
                </TargetFields>
              </JournalVouchers>
              <JournalEntries>
                <SourceFields>
                  <RecordKey />
                  <Recordkey />
                  <JdtNum />
                  <Reference />
                  <Reference2 />
                  <Memo />
                  <U_GLOSAM />
                  <ReferenceDate />
                </SourceFields>
                <TargetFields>
                  <RecordKey>RecordKey</RecordKey>
                  <Recordkey>RecordKey</Recordkey>
                  <Reference>Reference</Reference>
                  <Reference2>Reference2</Reference2>
                  <Memo>Memo</Memo>
                  <U_GLOSAM>U_GlosaM</U_GLOSAM>
                  <ReferenceDate>ReferenceDate</ReferenceDate>
                </TargetFields>
              </JournalEntries>
              <JournalEntries_Lines>
                <SourceFields>
                  <RecordKey />
                  <ParentKey />
                  <Line_ID />
                  <AccountCode />
                  <FCDebit />
                  <FCCredit />
                  <FCCurrency />
                  <DueDate />
                  <ShortName />
                  <ContraAccount />
                  <LineMemo />
                  <CostingCode2 />
                  <U_FechaFac />
                  <U_IUE />
                  <U_CARDNAME />
                  <U_ICE />
                  <U_EXENTO />
                  <U_Importe />
                  <U_TipoDoc />
                  <U_CODALFA />
                  <U_NUM_FACT />
                  <U_NUMORDER />
                  <U_NUMPOL />
                  <U_RUC />
                  <U_TIPOCOM />
                  <U_DESCUENTO />
                  <U_ESTADOFC />
                </SourceFields>
                <TargetFields>
                  <RecordKey>RecordKey</RecordKey>
                  <Line_ID>Line_ID</Line_ID>
                  <AccountCode>AccountCode</AccountCode>
                  <FCDebit>FCDebit</FCDebit>
                  <FCCredit>FCCredit</FCCredit>
                  <FCCurrency>FCCurrency</FCCurrency>
                  <DueDate>DueDate</DueDate>
                  <ShortName>ShortName</ShortName>
                  <ContraAccount>ContraAccount</ContraAccount>
                  <LineMemo>LineMemo</LineMemo>
                  <CostingCode2>CostingCode2</CostingCode2>
                  <U_FechaFac>U_FechaFac</U_FechaFac>
                  <U_IUE>U_IUE</U_IUE>
                  <U_CARDNAME>U_CARDNAME</U_CARDNAME>
                  <U_ICE>U_ICE</U_ICE>
                  <U_EXENTO>U_EXENTO</U_EXENTO>
                  <U_Importe>U_Importe</U_Importe>
                  <U_TipoDoc>U_TipoDoc</U_TipoDoc>
                  <U_CODALFA>U_CODALFA</U_CODALFA>
                  <U_NUM_FACT>U_NUM_FACT</U_NUM_FACT>
                  <U_NUMPOL>U_NUMPOL</U_NUMPOL>
                  <U_RUC>U_RUC</U_RUC>
                  <U_TIPOCOM>U_TIPOCOM</U_TIPOCOM>
                  <U_DESCUENTO>U_DESCUENTO</U_DESCUENTO>
                  <U_ESTADOFC>U_ESTADOFC</U_ESTADOFC>
                </TargetFields>
              </JournalEntries_Lines>
            </Fields>
          </Map>
          <Run>
            <Import>1</Import>
            <Rollback>True</Rollback>
            <MaxError>10</MaxError>
            <Update>0</Update>
            <TestRun>0</TestRun>
            <AddAllItems>Checked</AddAllItems>
            <LineData>0</LineData>
            <DataType>2</DataType>
            <MultiThread>False</MultiThread>
            <ThreadNum>4</ThreadNum>
          </Run>
        </Transfer>";
    }
    public function handleGetCuentaContable(){
      return Response::json(DB::table('Cuenta_Contable')->get());
    }
}
