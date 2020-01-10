<?php
namespace App\Hana\SQL;
use App\Hana\ODBC;

class Seguimiento extends ODBC
{
    public function getDatos($sucursal){
        $sql= <<<EOF
        select T0."OV_COD_SAP",T0."OV_NOM_CLIENTE",T0."OV_FEC_ENTREGA",T0."OV_COMENTARIOS",T0."PROCESADO",T0."TIPO",T0."PICKING",T0."PENDIENTE_FACTURACION" from LEVCORP.SEGUIMIENTO_OV T0
        where T0."PO_SUCURSAL" like '$sucursal'
        GROUP BY T0."OV_COD_SAP",T0."OV_NOM_CLIENTE",T0."OV_FEC_ENTREGA",T0."OV_COMENTARIOS",T0."PROCESADO" ,T0."TIPO",T0."PICKING",T0."PENDIENTE_FACTURACION"    
        EOF;
        return parent::query(utf8_decode($sql));
    }
    public function getDetalle($request){
        $sql= <<<EOF
        select 
        T0."OV_NO_ITEM_OC",
        T0."OV_ENTREGA_PARCIAL",
        T0."PO_NOM_PROVEEDOR",
        T0."PO_MED_EMBARQUE",
        T0."PO_COD_ARTICULO" ,
        T0."PO_COD_VENTA",
        T0."PO_DESCRIPCION",
        T0."PO_CANTIDAD",
        T0."PO_ALMACEN",
        T0."PO_FEC_CONTABILIZACION",
        T0."PO_FEC_ENTREGA_ARTICULO",
        T0."PO_T_FABRICACION",
        T0."PO_F_PED_PROV",
        T0."PO_F_EST_PED_PROV",
        T0."PO_F_EST_ENT_FAB",
        T0."PO_F_ENT_FAB",
        T0."PO_F_EMB_PROV",
        T0."PO_F_EST_EMB_PROV",
        T0."PO_F_ARRB_PUERTO",
        T0."PO_F_EST_ARRB_PUERTO",
        T0."PO_F_ARRB_BO",
        T0."PO_F_EST_ARRB_BO",
        T0."PO_F_DESADUANIZACION",
        T0."PO_F_EST_DESADUANIZACION",
        T0."PO_F_ALMACENES",
        T0."PO_F_EST_ALMACENES"
        from LEVCORP.SEGUIMIENTO_OV T0 
        where T0."OV_COD_SAP" = $request->DocNum      
        and T0."PO_COD_VENTA" is not null
        EOF;
        return parent::query(utf8_decode($sql));
    }
    public function getAll($sucursal){
        $sql=<<<EOF
        select * from LEVCORP.SEGUIMIENTO_OV
        where "PO_SUCURSAL" like '$sucursal'
        EOF;
        return parent::query(utf8_decode($sql));
    }
    
}