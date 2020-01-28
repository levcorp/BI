<?php
namespace App\Hana\SQL;
use App\Hana\ODBC;
use App\Sucursal;
use App\User;
use Response;
use App\ListaAlmacen;
use App\AsignacionAlmacen;
use App\FabricanteAsignacion;
use App\ArticulosAlmacen;
use Carbon\Carbon;
use DateTime;
class Almacen extends ODBC{
  public function WhsCode($sucursal){
    $ciudad=Sucursal::findOrFail($sucursal)->ciudad;
    switch ($ciudad) {
      case 'La Paz':
          return "LPZ001";
        break;
      case 'Cochabamba':
          return "CBB001";
        break;
      case 'Santa Cruz':
          return "SCZ001";
        break;
    }
  }
  public function ArticulosStock($sucursal){   
    $sucursal=$this->WhsCode($sucursal);
      $sql= <<<EOF
        SELECT T1."U_UbicFis", T0."ItemCode", T0."U_Cod_Vent", T1."OnHand", T0."ItemName", T2."FirmName", T1."WhsCode",
        CASE WHEN T0."QryGroup1" = 'y' THEN 'Primario'
        WHEN T0."QryGroup2" = 'Y' THEN 'Campaña'
        WHEN T0."QryGroup3" = 'Y' THEN 'Campaña'
        ELSE 'Sin Clasificación' END "Tipo"
        FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
        WHERE  T1."WhsCode" = '$sucursal'
        AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
        AND T1."OnHand" > 0
      EOF;
      return parent::query(utf8_decode($sql));
  }
  public function EditFabricantes($request){
    $asignaciones=AsignacionAlmacen::select('id')->where('LISTA_ID',$request->lista_id)->get();
    $asignaciones=$asignaciones->where('id','!=',$request->asignacion_id);
    $reg=FabricanteAsignacion::select('COD_FABRICANTE')->whereIn('ASIGNACION_ID',$asignaciones)->count();
    if($reg>0){
      $fabricantes=FabricanteAsignacion::select('COD_FABRICANTE')->whereIn('ASIGNACION_ID',$asignaciones)->get();
      $fab="(";
      foreach ($fabricantes as $key => $value) {
          $fab.="'".$value->COD_FABRICANTE."',";
      }
      $fab = substr ($fab, 0, strlen($fab) - 1);
      $fab.=")";
      $sucursal=$this->WhsCode($request->sucursal_id);
      $sql=<<<EOF
      SELECT T2."FirmName",T2."FirmCode"
        FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
        WHERE  T1."WhsCode" like '$sucursal'
        AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
        AND T1."OnHand" > 0 AND T2."FirmCode" NOT IN $fab
        Group By T2."FirmName",T2."FirmCode"
      EOF;
    }else{
      $sucursal=$this->WhsCode($request->sucursal_id);
      $sql=<<<EOF
      SELECT T2."FirmName",T2."FirmCode"
        FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
        WHERE  T1."WhsCode" like '$sucursal'
        AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
        AND T1."OnHand" > 0
        Group By T2."FirmName",T2."FirmCode"
      EOF;
    }
    return parent::query(utf8_decode($sql));
  }
  public function Fabricantes($request){
    $reg=FabricanteAsignacion::select('COD_FABRICANTE')->whereIn('ASIGNACION_ID',AsignacionAlmacen::select('id')->where('LISTA_ID',$request->lista_id)->get())->count();
    if($reg>0){
      $fabricantes=FabricanteAsignacion::select('COD_FABRICANTE')->whereIn('ASIGNACION_ID',AsignacionAlmacen::select('id')->where('LISTA_ID',$request->lista_id)->get())->get();
      $fab="(";
      foreach ($fabricantes as $key => $value) {
          $fab.="'".$value->COD_FABRICANTE."',";
      }
      $fab = substr ($fab, 0, strlen($fab) - 1);
      $fab.=")";
      $sucursal=$this->WhsCode($request->sucursal_id);
      $sql=<<<EOF
      SELECT T2."FirmName",T2."FirmCode"
        FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
        WHERE  T1."WhsCode" like '$sucursal'
        AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
        AND T1."OnHand" > 0 AND T2."FirmCode" NOT IN $fab
        Group By T2."FirmName",T2."FirmCode"
      EOF;
    }else{
      $sucursal=$this->WhsCode($request->sucursal_id);
      $sql=<<<EOF
      SELECT T2."FirmName",T2."FirmCode"
        FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
        WHERE  T1."WhsCode" like '$sucursal'
        AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
        AND T1."OnHand" > 0
        Group By T2."FirmName",T2."FirmCode"
      EOF;
    }
    return parent::query(utf8_decode($sql));
  }
  public function Usuarios($lista_id){
    return Response::json(User::select('Nombre','Apellido','id')->whereNotIn('id',AsignacionAlmacen::select('USUARIO_ID')->where('LISTA_ID',$lista_id)->get())->get());
  }
  public function StoreLista($request){
    ListaAlmacen::create($request->all());
  }
  public function Listas($usuario_id){
    return Response::json(ListaAlmacen::where('USUARIO_ID',$usuario_id)->orderBy('id','desc')->get());
  }
  public function DeleteLista($id){
    ListaAlmacen::findOrFail($id)->delete();
  }
  public function UpdateLista($request){
    ListaAlmacen::findOrFail($request->LISTA_ID)->fill($request->all())->save();
  }
  public function StoreAsignacion($request){
    AsignacionAlmacen::create([
      'USUARIO_ID'=>$request->USUARIO,
      'LISTA_ID'=>$request->LISTA_ID
    ]);
  }
  public function StoreFabricante($request){
    $data=AsignacionAlmacen::where('LISTA_ID',$request->LISTA_ID)->where('USUARIO_ID',$request->USUARIO)->first();
    foreach ($request->FABRICANTES as $value) {
      FabricanteAsignacion::create([
        'COD_FABRICANTE'=>$value,
        'ASIGNACION_ID'=>$data->id,
        'FABRICANTE'=>$value
      ]);
    }
  }
  public function Asignaciones($lista_id){
    return Response::json(AsignacionAlmacen::where('LISTA_ID',$lista_id)->with('usuario','fabricantes')->get());
  }
  public function DeleteFabricante($id){
    FabricanteAsignacion::findOrFail($id)->delete();
  }
  public function DeleteAsignacion($id){
    FabricanteAsignacion::where('ASIGNACION_ID',$id)->delete();
    AsignacionAlmacen::findOrFail($id)->delete();
  }
  public function UpdateAsignacion($request){
    FabricanteAsignacion::where('ASIGNACION_ID',$request->ASIGNACION_ID)->delete();
    foreach ($request->FABRICANTES as $value) {
      FabricanteAsignacion::create([
        'COD_FABRICANTE'=>$value,
        'ASIGNACION_ID'=>$request->ASIGNACION_ID,
        'FABRICANTE'=>$value
      ]);
    }
  }
  public function GetUsuarioListas($usuario_id){
    return Response::json(AsignacionAlmacen::where('USUARIO_ID',$usuario_id)->with('lista')->orderBy('id','desc')->get());
  }
  public function GetFabricantesAsignados($request){
    return Response::json(AsignacionAlmacen::where('id',$request->id)->with(array('fabricantes'=>function($querry){
      $querry->orderBy('FABRICANTE','asc');
    }))->first());
  }
  //AlmacenUsuario
  public function countArticulos($FirmCode,$sucursal){
    $sql=<<<EOF
      SELECT count(T2."FirmCode") as CountArticulos
      FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
      WHERE  T1."WhsCode" = '$sucursal'
      AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
      AND T1."OnHand" > 0 and T2."FirmCode" = '$FirmCode'
      group By T0."FirmCode"
    EOF;
    return parent::query(utf8_decode($sql));
  }
  //AlmacenUsuario
  public function GetArticulos($request){
    $count=ArticulosAlmacen::select('ITEMCODE')->where('FABRICANTE_ASIGNACION_ID',$request->fabricante_asignacion_id)->count();
    if($count>0){
      $codes=ArticulosAlmacen::select('ITEMCODE')->where('FABRICANTE_ASIGNACION_ID',$request->fabricante_asignacion_id)->get();
      $ItemCode="(";
      foreach ($codes as $key => $value) {
          $ItemCode.="'".$value->ITEMCODE."',";
      }
      $ItemCode = substr ($ItemCode, 0, strlen($ItemCode) - 1);
      $ItemCode.=")";
      $sucursal=$this->WhsCode($request->sucursal_id);
      $sql= <<<EOF
        SELECT T1."U_UbicFis", T0."ItemCode", T0."U_Cod_Vent", T1."OnHand", T0."ItemName", T2."FirmName", T1."WhsCode",
        CASE WHEN T0."QryGroup1" = 'y' THEN 'Primario'
        WHEN T0."QryGroup2" = 'Y' THEN 'Campaña'
        WHEN T0."QryGroup3" = 'Y' THEN 'Campaña'
        ELSE 'Sin Clasificación' END "Tipo"
        FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
        WHERE  T1."WhsCode" = '$sucursal' and T2."FirmCode" like '$request->FirmCode'
        AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
        AND T1."OnHand" > 0 AND T0."ItemCode" NOT IN $ItemCode
        EOF;
        return parent::query(utf8_decode($sql));
    }else{
      $sucursal=$this->WhsCode($request->sucursal_id);
      $sql= <<<EOF
        SELECT T1."U_UbicFis", T0."ItemCode", T0."U_Cod_Vent", T1."OnHand", T0."ItemName", T2."FirmName", T1."WhsCode",
        CASE WHEN T0."QryGroup1" = 'y' THEN 'Primario'
        WHEN T0."QryGroup2" = 'Y' THEN 'Campaña'
        WHEN T0."QryGroup3" = 'Y' THEN 'Campaña'
        ELSE 'Sin Clasificación' END "Tipo"
        FROM LEVCORP.OITM T0 INNER JOIN LEVCORP.OITW T1 ON T0."ItemCode" = T1."ItemCode" INNER JOIN LEVCORP.OMRC T2 ON T0."FirmCode" = T2."FirmCode"
        WHERE  T1."WhsCode" = '$sucursal' and T2."FirmCode" like '$request->FirmCode'
        AND SUBSTRING(T0."ItemCode",0,5) NOT IN ('401-', '150-')
        AND T1."OnHand" > 0
        EOF;
        return parent::query(utf8_decode($sql));
    }
  }
  public function StoreArticulos($request){
      ArticulosAlmacen::create($request->all()) ;
  }
  public function GetArticulosCheck($request){
      return Response::json(ArticulosAlmacen::where('FABRICANTE_ASIGNACION_ID',$request->asignacion_fabricante_id)->orderBy('id','desc')->get());
  }

}
