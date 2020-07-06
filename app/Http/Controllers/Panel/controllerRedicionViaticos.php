<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RendicionViaticos;
use App\RendicionSolicitud;
use Response;
use App\RendicionViaticosDetalle;
use QrCode;
use DB;
use Excel;
use App\Exports\AsientoContableCabezera;
use App\Exports\AsientoContableDetalle;
use Carbon\Carbon;
class controllerRedicionViaticos extends Controller
{
    //public function handleGetRendiciones(Request $request){
      //  return Response::json(RendicionViaticos::where('RESPONSABLE_ID',$request->usuario_id)->orderBy('id','asc')->get());
    //}
    public function handleStoreFactura(Request $request){
      $RendicionViaticos=RendicionSolicitud::where('id',$request->id)->first();
      if(is_null($request->CENTRO_COSTOS_ID)){
        $CENTRO_COSTOS_ID=$RendicionViaticos->CENTRO_COSTOS_ID;
      }else{
        $CENTRO_COSTOS_ID=$request->CENTRO_COSTOS_ID;
      }
      RendicionViaticosDetalle::create([
        'FECHA_GASTO'=>$request->Fecha_Emision,
        'DESCRIPCION'=>$request->Descripcion,
        'IMPORTE_PAGADO'=>$request->Total,
        'TIPO'=>'Con IVA',
        'IMPORTE_GASTO'=>$request->Total-($request->Total*0.13),
        'CREDITO_FISCAL'=>$request->Total*0.13,
        'ESPECIFICACION'=>1,
        'FECHA_FACTURA'=>$request->Numero_Factura,
        'NIT_PROVEEDOR'=>$request->NIT_Emisor,
        'N_FACTURA'=>$request->Numero_Factura,
        'N_DUI'=>0,
        'SUBTOTAL'=>$request->Total,
        'DESCUENTO'=>$request->Descuentos,
        'IMPORTE_BASE'=>$request->Importe_Credito_Fiscal,
        'CREDITO_FISCAL_2'=>$request->Total*0.13,
        'RENDICION_VIATICOS_ID'=>$request->id,
        'CENTRO_COSTOS_ID'=>$CENTRO_COSTOS_ID,
        'CODIGO_CONTROL'=>$request->Codigo_Control,
        'NUMERO_AUTORIZACION'=>$request->Numero_Autorizacion
      ]);
      $sum=0;
      $sum=$RendicionViaticos->MONTO_TOTAL+$request->Total;
      if($sum>$RendicionViaticos->IMPORTE_SOLICITADO){
        $rembolso=$sum-$RendicionViaticos->IMPORTE_SOLICITADO;
        RendicionSolicitud::findOrFail($request->id)->fill(['IMPORTE_REEMBOLSO'=>$rembolso])->save();
      }
      RendicionSolicitud::findOrFail($request->id)->fill(['MONTO_TOTAL'=>$sum])->save();
    }
    public function handleStoreFacturaManual(Request $request){
      $RendicionViaticos=RendicionSolicitud::where('id',$request->id)->first();
      if(is_null($request->CENTRO_COSTOS_ID)){
        $CENTRO_COSTOS_ID=$RendicionViaticos->CENTRO_COSTOS_ID;
      }else{
        $CENTRO_COSTOS_ID=$request->CENTRO_COSTOS_ID;
      }
      RendicionViaticosDetalle::create([
        'FECHA_GASTO'=>$request->Fecha_Emision,
        'DESCRIPCION'=>$request->Descripcion,
        'IMPORTE_PAGADO'=>$request->Total,
        'TIPO'=>$request->tipo,
        'NIT_PROVEEDOR'=>$request->NIT_Emisor,
        'N_FACTURA'=>$request->Numero_Factura,
        'RENDICION_VIATICOS_ID'=>$request->id,
        'CENTRO_COSTOS_ID'=>$CENTRO_COSTOS_ID,
        'CODIGO_CONTROL'=>$request->Codigo_Control,
        'NUMERO_AUTORIZACION'=>$request->Numero_Autorizacion
      ]);
      $sum=0;
      $sum=$RendicionViaticos->MONTO_TOTAL+$request->Total;
      if(floatval($sum)>=floatval($RendicionViaticos->IMPORTE_SOLICITADO)){
        $rembolso=$sum-$RendicionViaticos->IMPORTE_SOLICITADO;
        RendicionSolicitud::findOrFail($request->id)->fill(['IMPORTE_REEMBOLSO'=>$rembolso])->save();
      }
      RendicionSolicitud::findOrFail($request->id)->fill(['MONTO_TOTAL'=>$sum])->save();
    }
    public function handleGetViaticoDetalle($id){
      return Response::json(RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',$id)->with('centrocostos')->get());
    }
    public function handleDeleteFactura($id){
      $rendicion=RendicionViaticosDetalle::findOrFail($id);
      $sum=0;
      $RendicionViaticos=RendicionSolicitud::where('id',$rendicion->RENDICION_VIATICOS_ID)->first();
      $less=$RendicionViaticos->MONTO_TOTAL-$rendicion->IMPORTE_PAGADO;
      RendicionSolicitud::findOrFail($rendicion->RENDICION_VIATICOS_ID)->fill(['MONTO_TOTAL'=>$less])->save();
      $rendicion->delete();
    }
    public function handleGetRendicion($id){
      return Response::json(RendicionSolicitud::where('id',$id)->with('banco','solicitado','autorizado','centrocostos','tiposolicitud')->first());
    }
    public function pruebaReporte(){
      //return $this->handlegetCodigoUsuario('13149840');
      $descargos=RendicionViaticosDetalle::where('RENDICION_VIATICOS_ID',1016)->with('centrocostos')->get();
      $solicitud=RendicionSolicitud::where('id',1016)->with('banco','solicitado','autorizado','solicitado.sucursal','centrocostos')->first();
      $firma=base64_encode($solicitud->AUTORIZADO_ID.'@'.$solicitud->SOLICITADO_ID.'@'.md5('10').'@'.$solicitud->FECHA_SOLICITUD);
      $firma = str_replace(array('M','N','='),array('A','B','C'),$firma);
      $qrcode = base64_encode(QrCode::color(10,10,10)->encoding('UTF-8')->merge( public_path().'\images\logoLevcorp.png',0.3,true)->format('png')->style('round')->size(500)->errorCorrection('H')->generate($firma));
      $pdf = \PDF::loadView('pdf.rendicion',compact('solicitud','qrcode','firma','descargos'));
      $pdf->setPaper("letter", "landscape");
      $pdf->getDomPDF()->set_option("enable_php", true);
      return $pdf->download('invoice.pdf');
    }
    public function pruebaSAP(){
      $nombre='Gabriel';
      $apellido='Pinto';
      $fecha=Carbon::now()->format('dmYHmms');
      $usuario=strtolower(substr($nombre,0,1).$apellido);
      $nombreCabeceraSegunda=$usuario.'\cabecera\\'.$fecha.'.csv';
      $nombreDetalle=$usuario.'\detalle\\'.$fecha.'.csv';
      $urlCabecera=base_path()."\public\archivos\rendicion\CabezeraAsientoContable.csv";
      $urlCabeceraSegunda=base_path().'\public\archivos\rendicion\\'.$nombreCabeceraSegunda;
      $urlDetalle=base_path().'\public\archivos\rendicion\\'.$nombreDetalle;
      Excel::store(new AsientoContableDetalle(1016), $nombreDetalle, 'rendicion', \Maatwebsite\Excel\Excel::CSV);
      //Excel::store(new AsientoContableCabezera(1016), $nombreCabeceraSegunda, 'rendicion', \Maatwebsite\Excel\Excel::CSV);
      //$xml=$this->xml($urlCabecera,$urlCabeceraSegunda,$urlDetalle);
      //Storage::disk('rendicion')->put($usuario.'\script.xml', $xml);
    }
    public function xml($urlCabecera,$urlCabeceraSegunda,$urlDetalle){
        return $archivo="<Transfer>
          <Logon>
            <UserName>sist_lp1</UserName>
            <Password>SIgJnJvLkLrDoDyFrB</Password>
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
              <JournalEntries>$urlCabeceraSegunda</JournalEntries>
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
                  <RefDate />
                </SourceFields>
                <TargetFields>
                  <RecordKey>RecordKey</RecordKey>
                  <Recordkey>RecordKey</Recordkey>
                  <Reference>Reference</Reference>
                  <Reference2>Reference2</Reference2>
                  <Memo>Memo</Memo>
                  <U_GLOSAM>U_GlosaM</U_GLOSAM>
                  <RefDate>ReferenceDate</RefDate>
                </TargetFields>
              </JournalEntries>
              <JournalEntries_Lines>
                <SourceFields>
                  <RecordKey />
                  <Line_ID />
                  <AccountCode />
                  <ShortName />
                  <Reference1 />
                  <Reference2 />
                  <FCDebit />
                  <FCCredit />
                  <Debit />
                  <Credit />
                  <DueDate />
                  <CostingCode2 />
                </SourceFields>
                <TargetFields>
                  <RecordKey>RecordKey</RecordKey>
                  <Line_ID>Line_ID</Line_ID>
                  <AccountCode>AccountCode</AccountCode>
                  <ShortName>ShortName</ShortName>
                  <Reference1>Reference1</Reference1>
                  <Reference2>Reference2</Reference2>
                  <FCDebit>FCDebit</FCDebit>
                  <FCCredit>FCCredit</FCCredit>
                  <Debit>Debit</Debit>
                  <Credit>Credit</Credit>
                  <DueDate>DueDate</DueDate>
                  <CostingCode2>CostingCode2</CostingCode2>
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
    public function handlegetCodigoUsuario($ci){
      $codigo=DB::table('Codigo_Usuario')->select('Codigo_Usuario.CardCode')->where('Codigo_Usuario.LicTradNum',$ci)->first();
      if(isset($codigo->CardCode)){
        return $codigo->CardCode;
      }else{
        return "No existe el usuario";
      }
    }
    public function handleGetCuentaContable(){
      return Response::json(DB::table('Cuenta_Contable')->get());
    }
}
