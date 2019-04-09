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
        <div class="row" style="width: 50%">
            <img src="{{asset('images\levcorp.png')}}" alt="">
            <div style="margin-bottom: 0px;padding-bottom: 0px;">
                <hr style="color: red ">  
                <p style="color:#1f497d; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;">{{strtoupper($usuario->nombre." ".$usuario->apellido)}}</p>
                <p style="color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;">{{ucwords($usuario->cargo)}}</p>
                <hr style="color: red" >
                <div style="background-color:#d5dcdd ">
                    <p  style="font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;"><span style="color:red">&#9742;</span><b> Telf  : </b> (591-2) -  2815658 </p>	
                    <p style="font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;"><span style="color:red">&#128224;</span><b> Fax  : </b> (591-2) -  2782126 </p>
                    <p style="font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;"> <span style="color:red">&#128222;</span> <b> Cel.  : </b> </p>
                    <p style="font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;"><span style="color:red">&#128231;</span><b> Email  : </b> {{$usuario->email}}</p>
                    <p style="font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;"><span style="color:red"> &#1698;</span><b> C. 15 de Agosto No. 1789 esq. Villa de Oropeza 
                        <p style="padding-left:5px;font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;">&nbsp;Zona Villa Galindo</p>
                        <p style="padding-left:5px;font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;">&nbsp;Cochabamba - Bolivia</p>
                    </b> </p>	
                    <p style="padding-left:5px;font-size:14px;color:#1f497d ; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin: 0px 0px;padding: 0px 0px;">&nbsp;www.levcorp.bo</p>
                </div>  
            </div>
        </div>

        </body>
    </html>
