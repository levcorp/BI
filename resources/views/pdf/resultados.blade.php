<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados Cuestionario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div style="margin-right: 0px; padding-right: 0px;">
                    <div style="text-align: right">
                        <img src="{{ public_path().'/images/LevcorpPDF.png'}}" alt="" width="180" height="75">
                    </div>
                </div>
            </td>
            <td style="width: 65px"></td>
            <td style="text-align: center">
                <p><strong>Resultados de Cuestionario</strong></p>
            </td>
        </tr>
    </table>
    <div style="background-color: #F56C6C;width: 690px ;height: 2px; margin-top: 10px; margin-bottom: 20px;"></div>
    <div style="width: 690px;text-align: center">
        <p style="font-size: 15px; color:#303133 "><strong>{{$cuestionario->TITULO}}</strong></p>        
    </div>
    <table>
        @foreach ($data as $item)
            <tr>
                <th colspan="4" style="width: 690px;text-align: left">
                    <p style="font-size: 13px; color:#606266 ">{{$item->PREGUNTA}}</p>
                </th>
            </tr>
            @foreach ($item->vresp as $item2)
            <tr>
                    <td style="text-align: right">
                        <p style="font-size: 13px; color:#606266 "> <strong>RESPUESTA:</strong><span></span></p>
                    </td>
                    <td style="text-align: left">
                        <p style="font-size: 13px; color:#409EFF; padding-left: 5px;"> <strong>{{$item2->VALOR}}</strong><span></span></p>
                    </td>
                    <td style="text-align: right">
                        <p style="font-size: 13px; color:#606266 "> <strong>CANTIDAD:</strong></p>
                    </td>
                    <td style="text-align: left"> 
                        <p style="font-size: 13px; color:#409EFF; padding-left: 5px;"> <strong>{{$item2->CONTADOR}}</strong></p>              
                    </td>
            </tr>
            @endforeach
        @endforeach
    </table>
    <script type="text/php">
        if (isset($pdf)) {
            $text = "Pagina {PAGE_NUM}";
            $size = 10;
            $font = $fontMetrics->getFont("Verdana");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
        }
    </script>
</body>
</html>