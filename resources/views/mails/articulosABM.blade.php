    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta http-equiv="X-UA-Compatible" content="ie=edge" />
            <title>Articulos ABM</title>
        </head>
        <body>
        <div class="">
            <div class="">
                <div class="" >
                    <p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px; ">Datos del usuario que realizao la solicitud :</p>
                    <table style="font-size: 12px; font-family: Arial, Helvetica, sans-serif;">
                        <tr style="margin: 5px;">
                            <th style="text-align: center;background-color: #0080c0; color: white;">Nombre</th>
                            <td style="text-align: center;background-color: #dae6e7">{{ucwords($usuario->nombre." ".$usuario->apellido)}}</td>
                        </tr>
                        <tr style="margin: 5px;">
                            <th style="text-align: center;background-color: #0080c0; color: white;">Correo Electronico</th>
                            <td style="text-align: center;background-color: #dae6e7">{{$usuario->email}}</td>
                        </tr>
                    </table>
                    <p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px; ">La solicitud de los articulos tiene el siguiente detalle:</p>
                    <table style="font-size: 12px; font-family: Arial, Helvetica, sans-serif;"> 
                        <thead style="margin: 5px;">
                            <tr style=" background-color: #0080c0; color: white; ">
                                <th style="text-align: center">Serie</th>
                                <th style="text-align: center">Fabricante</th>
                                <th style="text-align: center">Proveedor</th>
                                <th style="text-align: center">Especialidad</th>
                                <th style="text-align: center">Familia</th>
                                <th style="text-align: center">Sub Familia</th>
                                <th style="text-align: center">Unidad Medida</th>
                                <th style="text-align: center">Cod Venta</th>
                                <th style="text-align: center">Cod Compra</th>
                                <th style="text-align: center">Descripcion</th>
                                <th style="text-align: center">Comentario</th>
                            </tr>
                        </thead>
                        <tbody style="margin: 5px;">
                            @foreach ($articulos as $articulo)
                            <tr style="background-color: #dae6e7">
                                <td style="text-align: center">{{$articulo->serie}}</td>
                                <td style="text-align: center">{{$articulo->fabricante}}</td>
                                <td style="text-align: center">{{$articulo->proveedor}}</td>
                                <td style="text-align: center">{{$articulo->especialidad}}</td>
                                <td style="text-align: center">{{$articulo->familia}}</td>
                                <td style="text-align: center">{{$articulo->subfamilia}}</td>
                                <td style="text-align: center">{{$articulo->medida}}</td>
                                <td style="text-align: center">{{$articulo->cod_venta}}</td>
                                <td style="text-align: center">{{$articulo->cod_compra}}</td>
                                <td style="text-align: center">{{$articulo->descripcion}}</td>
                                <td style="text-align: center">{{$articulo->comentarios}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p style="font-family: Arial, Helvetica, sans-serif;font-size: 12px; ">Este mensaje fue enviado automaticamente, no es ncesario que responda.</p>
                </div>   
            </div>
        </div>
        
        </body>
    </html>
