<?php
namespace App\Hana\SQL;
use App\Hana\ODBC;

class Panel extends ODBC
{
    public function getFacturacion(){
        $sql= <<<EOF
            Select MONTH(T0.PERIODO) as MES,CAST (sum(T0.total_USD) as INTEGER) as TOTAL_FACTURACION 
            from LEVCORP.REPORTE_VENTAS T0
            where YEAR(T0.PERIODO)=2020
            group By MONTH(T0.PERIODO)
            order by MONTH(T0.PERIODO)
        EOF;
        return parent::query(utf8_decode($sql));
    }

     public function getFacturacionMercado($value){
        $sql= <<<EOF
            Select MONTH(T0.PERIODO) as MES,CAST (sum(T0.total_USD) as INTEGER) as TOTAL_FACTURACION 
            from LEVCORP.REPORTE_VENTAS T0
            where YEAR(T0.PERIODO)=2020 and T0.Sector='$value'
            group By MONTH(T0.PERIODO)
            order by MONTH(T0.PERIODO)
        EOF;
        return parent::query(utf8_decode($sql));
    }
}