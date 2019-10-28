<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use App\Hana\SQL\Almacen;
use App\Hana\ODBC;
class DatosAlmacenExport implements FromView
{
    public function view(): View
    {
        $almacen=new Almacen;
        $ODBC = new ODBC;
        //$sucursal=$almacen->WhsCode($sucursal);
        $sql= <<<EOF
          SELECT T1."U_UbicFis", T0."ItemCode", T0."U_Cod_Vent", T1."OnHand", T0."ItemName", T2."FirmName", T1."WhsCode",
          CASE WHEN T0."QryGroup1" = 'y' THEN 'Primario'
          WHEN T0."QryGroup2" = 'Y' THEN 'Campaña'
          WHEN T0."QryGroup3" = 'Y' THEN 'Campaña'
          ELSE 'Sin Clasificación' END "Tipo"
          FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
          WHERE  T1."WhsCode" = 'LPZ001'
          AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
          AND T1."OnHand" > 0
          EOF;
        $datos=$ODBC->query(utf8_decode($sql));
        return view('exports.datosAlmacenExport', compact('datos'));
    }
}
