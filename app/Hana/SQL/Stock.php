<?php
namespace App\Hana\SQL;
use App\Hana\ODBC;
class Stock extends ODBC{
  public function stock($datos){
    if($request->Type=='descForm'){
        return response()->json(DB::table('OITW')->where('ItemName','like',$datos->ItemName.'%')->get());
    }
    if($request->Type=='codForm'){
        return response()->json(DB::table('OITW')->where('U_Cod_Vent','like',$datos->U_Cod_Vent.'%')->get());
    }
    if($request->Type=='fabForm'){
        return response()->json(DB::table('OITW')->where('ItemName','like',$datos->ItemName.'%')->where('FirmName','like',$datos->FirmName.'%')->get());
    }else{
        return response()->json('');
    }
    $sql=<<<EOF
    Select T1."ItemCode",T1."ItemName",T1."U_Cod_Vent",T2."FirmName",T3."Price"
    From Levcorp.OITM T1
    inner join Levcorp.OMRC T2 on T1."FirmCode" = T2."FirmCode"
    inner join Levcorp.ITM1 T3 on T1."ItemCode" = T3."ItemCode"
    and T3."PriceList"=8
    EOF;
  }
}
