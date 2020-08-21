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
              SOLICITUD DE FONDOS A CUENTA DE RENDICIÓN
            </strong>
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;"> <strong>Fecha de Solicitud:</strong> </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">{{date('Y-m-d', strtotime($solicitud->FECHA_SOLICITUD))}}</p>
        </td>
        <td style="text-align: center;font-size:12px;"  width="40%"> <p style="margin:7px 0px;"><strong>Fecha de desembolso requerido:</strong></p> </td>
        <td style="text-align: left;font-size:12px;"  width="20%">
          <p style="margin:7px 0px;">{{date('Y-m-d', strtotime($solicitud->FECHA_DESEMBOLSO))}}</p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Descripción:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="80%">
          <p style="margin:7px 0px;">
            {{$solicitud->DESCRIPCION}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Importe Solicitado:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            {{'Bs. '.number_format($solicitud->IMPORTE_SOLICITADO, 2)}}
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="60%">
          <p style="margin:7px 0px;">
            {{$label}} {{$decimal}}/100 BOLIVIANOS
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Solicitado por:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido}}
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Cedula de Identidad:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->solicitado->ci}}
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Autorizado por:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->autorizado->nombre.' '.$solicitud->autorizado->apellido}}
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Comentario Autorizador:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
              {{$solicitud->COMENTARIOS}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            <strong>
              Concepto o motivo de la solicitud:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="70%">
          <p style="margin:7px 0px;">
              {{$solicitud->MOTIVO}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Medio de Pago:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->MEDIO_PAGO}} {{$solicitud->MEDIO_PAGO=='Abono Cuenta Bancaria'? 'N°'.$solicitud->CUENTA:''}}
          </p>
        </td>
        <td style="text-align: right;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Banco:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->banco->Nombre}}
          </p>
        </td>
      </tr>
    </table>
    <br>
    <br>
    @if(isset($firma))
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: center;font-size:12px;" width="100%">
          <p style="margin:0px 0px 5px 0px;">
            <strong>
              <img src="data:image/png;base64, {!! $qrcode !!}"  width="100" height="100">
            </strong>
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: center;font-size:12px;" width="100%">
          <p style="margin:0px 0px 5px 0px;">
            <strong>
                {{$firma}}
            </strong>
          </p>
        </td>
      </tr>
    </table>
    @else
    <table cellpadding="0" cellspacing="0" style="width:100%;height:120px">
    </table>
    @endif
    <hr style="margin:20px 0px 15px 0px;width:100%">
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
          <td style="font-size:10px" height="9"><p style="margin:0px;">{{Carbon\Carbon::now()->format('h:i:s')}}</p></td>
        </tr>
        <tr class="cabecera">
          <td style="text-align: left;font-size:10px;" ><p style="margin:0px;"><strong>Sucursal:</strong></p></td>
          <td style="font-size:10px;"><p style="margin:0px;">{{$solicitud->solicitado->sucursal->ciudad}}</p></td>
        </tr>
        <tr class="cabecera">
          <td style="text-align: left;font-size:10px;" ><p style="margin:0px;"><strong></strong></p></td>
          <td style="text-align: left;font-size:10px;" ><p style="margin:0px;"><strong>COPIA</strong></p></td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td colspan="4" style="text-align: center" width="100%">
          <p style="margin:25px;">
            <strong>
              SOLICITUD DE FONDOS A CUENTA DE RENDICIÓN
            </strong>
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;"> <strong>Fecha de Solicitud:</strong> </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">{{date('Y-m-d', strtotime($solicitud->FECHA_SOLICITUD))}}</p>
        </td>
        <td style="text-align: center;font-size:12px;"  width="40%"> <p style="margin:7px 0px;"><strong>Fecha de desembolso requerido:</strong></p> </td>
        <td style="text-align: left;font-size:12px;"  width="20%">
          <p style="margin:7px 0px;">{{date('Y-m-d', strtotime($solicitud->FECHA_DESEMBOLSO))}}</p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Descripción:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="80%">
          <p style="margin:7px 0px;">
            {{$solicitud->DESCRIPCION}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Importe Solicitado:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            {{'Bs. '.number_format($solicitud->IMPORTE_SOLICITADO, 2)}}
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="60%">
          <p style="margin:7px 0px;">
            {{$label}} {{$decimal}}/100 BOLIVIANOS
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Solicitado por:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->solicitado->nombre.' '.$solicitud->solicitado->apellido}}
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Cedula de Identidad:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->solicitado->ci}}
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Autorizado por:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->autorizado->nombre.' '.$solicitud->autorizado->apellido}}
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Comentario Autorizador:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->COMENTARIOS}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            <strong>
              Concepto o motivo de la solicitud:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="70%">
          <p style="margin:7px 0px;">
              {{$solicitud->MOTIVO}}
          </p>
        </td>
      </tr>
    </table>
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: left;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Medio de Pago:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->MEDIO_PAGO}} {{$solicitud->MEDIO_PAGO=='Abono Cuenta Bancaria'? 'N°'.$solicitud->CUENTA:''}}
          </p>
        </td>
        <td style="text-align: right;font-size:12px;" width="20%">
          <p style="margin:7px 0px;">
            <strong>
              Banco:
            </strong>
          </p>
        </td>
        <td style="text-align: left;font-size:12px;" width="30%">
          <p style="margin:7px 0px;">
            {{$solicitud->banco->Nombre}}
          </p>
        </td>
      </tr>
    </table>
    <br>
    <br>
    @if(isset($firma))
    <table cellpadding="0" cellspacing="0" style="width:100%;">
      <tr>
        <td style="text-align: center;font-size:12px;" width="100%">
          <p style="margin:0px 0px 5px 0px;">
            <strong>
              <img src="data:image/png;base64, {!! $qrcode !!}"  width="100" height="100">
            </strong>
          </p>
        </td>
      </tr>
      <tr>
        <td style="text-align: center;font-size:12px;" width="100%">
          <p style="margin:0px 0px 5px 0px;">
            <strong>
                {{$firma}}
            </strong>
          </p>
        </td>
      </tr>
    </table>
    @endif
</body>
</html>
