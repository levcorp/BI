<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud de Fondos</title>
    <link type="text/css" href="{{ public_path().'/public/bootstrap/css/bootstrap.css'}}" rel="stylesheet"/>
    <style type="text/css">
    @page {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    @font-face {
        font-family: 'Roboto';
        font-style: normal;
        font-weight: normal;
        src: url(https://fonts.googleapis.com/css?family=Roboto&display=swap) format('truetype');
        }
        body{
            font-family: 'Roboto', sans-serif;

        }
      #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; }
      #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px; background-color: lightblue; }
      #footer .page:after { content: counter(page, upper-roman); }
    </style>
</head>
<body>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
        <tr class="cabecera">
            <td rowspan="4" width="70%">
                <div style="margin-right: 0px; padding-right: 0px;">
                    <div style="text-align: left">
                        <img src="{{ public_path().'/images/LevcorpPDF.png'}}" alt="" width="130" height="50">
                    </div>
                </div>
            </td>
            <td style="text-align: left;font-size:10px;"><p style="margin:0px;"><strong>Fecha Impresión :</strong></p></td>
            <td style="font-size:10px"><p style="margin:0px;">{{Carbon\Carbon::now()->format('d-m-Y')}}</p></td>
        </tr>
        <tr class="cabecera">
          <td style="text-align: left;font-size:10px;"><p style="margin:0px;"><strong>Hora Impresión :</strong></p></td>
          <td style="font-size:10px" height="9"><p style="margin:0px;">{{Carbon\Carbon::now()->format('H:i:s')}}</p></td>
        </tr>
        <tr class="cabecera">
          <td style="text-align: left;font-size:10px;" ><p style="margin:0px;"><strong>Sucursal:</strong></p></td>
          <td style="font-size:10px;"><p style="margin:0px;">{{$solicitud->solicitado->sucursal->ciudad}}</p></td>
        </tr>
        <tr class="cabecera">
          <td style="text-align: left;font-size:10px;" ><p style="margin:0px;"><strong></strong></p></td>
          <td style="text-align: left;font-size:10px;" ><p style="margin:0px;"><strong>ORIGINAL</strong></p></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td colspan="4" style="text-align: center" width="100%">
          <p style="margin:25px;">
            <strong>
              RENDICIÓN DE VIATICOS ASIGNADOS
            </strong>
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Responsable de Fondo :
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">{{$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido}}</p>
        </td>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Cédula de Identidad Nº:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
              {{$solicitud->solicitado->ci}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Concepto o Motivo de la solicitud :
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="80%">
          <p style="margin:3px 0px;">
            {{$solicitud->MOTIVO}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Fecha de la rendicion:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
            {{Carbon\Carbon::now()->format('d-m-Y')}}
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Monto asignado con cargo a rendición:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
            Bs.    {{$solicitud->IMPORTE_SOLICITADO}}
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Fecha de la Asignación
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
            {{$solicitud->FECHA_DESEMBOLSO_TESORERIA}}
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Monto total del descargo:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
            Bs.    {{$solicitud->descargo}}
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Importe a Rembolsar al Empleado :
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
            Bs.    {{$solicitud->rembolso}}
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Centro de Costos:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
              {{$solicitud->centrocostos->NOMBRE}}
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Medio de Pago:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
            {{$solicitud->MEDIO_PAGO}} {{$solicitud->MEDIO_PAGO=='Abono Cuenta Bancaria'? 'N°'.$solicitud->CUENTA:''}}
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="20%">
          <p style="margin:3px 0px;">
            <strong>
              Banco :
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:10px;" width="30%">
          <p style="margin:3px 0px;">
              {{$solicitud->banco->Nombre}}
          </p>
        </td>
      </tr>
    </table>
    <br>
    <br>
    <table cellpadding="0" cellspacing="0" style="width:100%;" border="1">
      <tr>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Fecha Gasto
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Tipo
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Descripcion
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            NIT Proveedor
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Nº Factura
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Nº Autorizacion
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Codigo Control
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Importe Pagado
          </strong>
        </td>
        <td style="text-align: center;font-size:10px;" width="100%">
          <strong>
            Centro de Costos
          </strong>
        </td>
      </tr>
      @foreach($descargos as $key => $value)
        <tr>
          <td style="text-align: center;font-size:10px;" width="100%">{{is_null($value->FECHA_GASTO)?'-':$value->FECHA_GASTO}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{is_null($value->TIPO)?'-':$value->TIPO}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{$value->DESCRIPCION}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{is_null($value->NIT_PROVEEDOR)?'-':$value->NIT_PROVEEDOR}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{is_null($value->N_FACTURA)?'-':$value->N_FACTURA}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{is_null($value->N_AUTORIZADO)?'-':$value->N_AUTORIZADO}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{is_null($value->CODIGO_CONTROL)?'-':$value->CODIGO_CONTROL}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{$value->IMPORTE_PAGADO}}</td>
          <td style="text-align: center;font-size:10px;" width="100%">{{$value->centrocostos->NOMBRE}}</td>
        </tr>
      @endforeach
    </table>
    <div style="margin-top:100px;">
      <table cellpadding="0" cellspacing="0" style="width:100%;">
        <tr>
          <td style="text-align: center;font-size:12px;" width="100%">
            <p style="margin:0px 0px 5px 0px;">
              <br>
              <strong style="border-top:1px solid;padding:10px;margin:10px">
                Firma del Solicitante
              </strong>
            </p>
          </td>
        </tr>
      </table>
    </div>
</body>
</html>
