<?php
namespace App\Hana\SQL;
use App\Hana\ODBC;

class Socio extends ODBC
{
    public function getGrupos(){
        $sql= <<<EOF
        select T0."GroupCode",T0."GroupName" from LEVCORP.OCRG T0
        EOF;
        return parent::query(utf8_decode($sql));
    }
}