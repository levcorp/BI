<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
        <tr>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 5;">
                <strong>    
                    #
                </strong>
            </th>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 25;">
                <strong>
                    Fabricante
                </strong>
            </th>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 20;">
                <strong>
                    Item Code
                </strong>
            </th>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 25">
                <strong>
                    Codigo Ventas
                </strong>
            </th>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 50;">
                <strong>
                    Descripción
                </strong>
            </th>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 10">
                <strong>
                    Ubicación
                </strong>
            </th>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 10">
                <strong>
                    Cant. Stock
                </strong>
            </th>
            <th style="color:#FFFFFF;background-color:#4F81BD;text-align: center;width: 9">
                <strong>
                    Almacen
                </strong>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach(json_decode($datos) as $key =>$dato)
            <tr>
                <td style="border:1px solid #4F81BD;border-color:#4F81BD; text-align: center;">{{ $key+1 }}</td>
                <td style="border: 1px solid #4F81BD;border-color:#4F81BD;">{{ $dato->FirmName }}</td>
                <td style="border:1px solid #4F81BD;border-color:#4F81BD;">{{ $dato->ItemCode}}</td>
                <td style="border: 1px solid #4F81BD;border-color:#4F81BD;">{{ $dato->U_Cod_Vent}}</td>
                <td style="border: 1px solid #4F81BD;border-color:#4F81BD;">{{ $dato->ItemName}}</td>
                <td style="border: 1px solid #4F81BD;border-color:#4F81BD;">{{ $dato->U_UbicFis}}</td>
                <td style="border:1px solid #4F81BD;border-color:#4F81BD;">{{ $dato->OnHand}}</td>
                <td style="border: 1px solid #4F81BD;border-color:#4F81BD;">{{ $dato->WhsCode}}</td>                
            </tr>
        @endforeach
        </tbody>
        </table>
</body>
</html>