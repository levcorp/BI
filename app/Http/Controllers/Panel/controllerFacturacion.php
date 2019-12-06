<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Facturacion;
use DB;
class controllerFacturacion extends Controller
{      
    public function handleGetFacturacionTotal(){
        return DB::select(<<<EOF
            select	T0.GESTION,
            SUM(T0.TOTAL_FACTURAS) as TOTAL_FACTURAS, 
            SUM(T0.TOTAL_FACTURASA) as TOTAL_FACTURASA, 
            T0.MESFA,
            SUM(T0.TOTAL_OVA) as TOTAL_OVA, 
            T0.MESOVA,
            SUM(T0.TOTAL_OV) as TOTAL_OV,
            SUM(T0.OPORTUNIDADESTOTAL_MES) as OPORTUNIDADESTOTAL_MES,
            T0.MESCIERRE,
            SUM(T0.OPORTUNIDADESTOTAL_GESTION) as OPORTUNIDADESTOTAL_GESTION,
            SUM(ISNULL(T0.OPORTUNIDADESTOTAL_GESTION,0)+ISNULL(T0.OPORTUNIDADESTOTAL_MES,0)+ISNULL(T0.TOTAL_OV,0)+ISNULL(T0.TOTAL_OVA,0)+ISNULL(T0.TOTAL_FACTURASA,0)+ISNULL(T0.TOTAL_FACTURAS,0)) as Total
            From FACTURACION T0
            Group By T0.GESTION,T0.MESFA,T0.MESOVA,T0.MESCIERRE
        EOF);
    }
    public function handleGetFacturacion(){
        return Facturacion::all();
    }
    public function handleGetPedidos($sector){
        return DB::select(<<<EOF
            select * from (
                select REPORTE_OV.VENDEDOR,SUM(REPORTE_OV.total_USD) as Total,REPORTE_OV.Nombre_Cliente,REPORTE_OV.Sector,REPORTE_OV.Sucursal, MONTH(REPORTE_OV.Fecha_Entrega2) as Moth, YEAR(REPORTE_OV.Fecha_Entrega2) as 'Year'  
                from LEVCORP.dbo.REPORTE_OV REPORTE_OV
                where MONTH(REPORTE_OV.Fecha_Entrega2) = MONTH(GETDATE()) and YEAR(REPORTE_OV.Fecha_Entrega2)=  YEAR(GETDATE())  and REPORTE_OV.Sector='$sector'
                Group By REPORTE_OV.VENDEDOR,REPORTE_OV.Nombre_Cliente,REPORTE_OV.Sector,REPORTE_OV.Sucursal,MONTH(REPORTE_OV.Fecha_Entrega2),YEAR(REPORTE_OV.Fecha_Entrega2)      
            ) T0 where Total>=1
            order By T0.Sucursal 
        EOF);
    }
    public function handleGetPedidosAll($sector){
        return DB::select(<<<EOF
            select * from (
                select REPORTE_OV.VENDEDOR,SUM(REPORTE_OV.total_USD) as Total,REPORTE_OV.Nombre_Cliente,REPORTE_OV.Sector,REPORTE_OV.Sucursal, MONTH(REPORTE_OV.Fecha_Entrega2) as Moth, YEAR(REPORTE_OV.Fecha_Entrega2) as 'Year'  
                from LEVCORP.dbo.REPORTE_OV REPORTE_OV
                where YEAR(REPORTE_OV.Fecha_Entrega2) >= YEAR(GETDATE())  and REPORTE_OV.Sector='$sector' 
                Group By REPORTE_OV.VENDEDOR,REPORTE_OV.Nombre_Cliente,REPORTE_OV.Sector,REPORTE_OV.Sucursal,MONTH(REPORTE_OV.Fecha_Entrega2),YEAR(REPORTE_OV.Fecha_Entrega2)
            ) T0
            where T0.Total>=1   
            order By T0.Sucursal           
        EOF);
    }
    public function handleGetYear($sector){
        return DB::select(<<<EOF
            select YEAR(REPORTE_OV.Fecha_Entrega2) as 'Year'  
            from LEVCORP.dbo.REPORTE_OV REPORTE_OV
            where YEAR(REPORTE_OV.Fecha_Entrega2) >= YEAR(GETDATE()) and REPORTE_OV.Sector='$sector' 
            Group By YEAR(REPORTE_OV.Fecha_Entrega2)      
        EOF);
    }
    public function handleGetMes($sector){
        return DB::select(<<<EOF
            select * from (
                select SUM(REPORTE_OV.total_USD) as Total, MONTH(REPORTE_OV.Fecha_Entrega2) as Moth, YEAR(REPORTE_OV.Fecha_Entrega2) as 'Year'  
                from LEVCORP.dbo.REPORTE_OV REPORTE_OV
                where YEAR(REPORTE_OV.Fecha_Entrega2) >= YEAR(GETDATE()) and REPORTE_OV.Sector='$sector' 
                Group By MONTH(REPORTE_OV.Fecha_Entrega2),YEAR(REPORTE_OV.Fecha_Entrega2)
            ) T0
            where T0.Total>=1
        EOF);
    }
    public function handleGetPedidoDetalle(Request $request){
        return DB::select(<<<EOF
            select T0.N_OV_SAP,T0.FECHA_ENTREGA2,T0.Nombre_Cliente,T0.Vendedor,T0.Descricion,T0.cod_ventas,T0.Nombre_Fabricante,T0.Cantidad, SUM(total_USD) as total_USD
            FROM LEVCORP.dbo.REPORTE_OV T0
            where 
            MONTH(T0.Fecha_Entrega2) = '$request->mes'  
            and T0.Sector='$request->sector' 
            and YEAR(T0.Fecha_Entrega2) = '$request->year'
            and T0.Nombre_Cliente like '$request->cliente'
            GROUP BY T0.N_OV_SAP, T0.FECHA_ENTREGA2,T0.Nombre_Cliente,T0.Vendedor,T0.Descricion,T0.cod_ventas,T0.Nombre_Fabricante,T0.Cantidad 
            order by total_USD desc
        EOF);
    }
    public function handleGetOportunidadesMes(Request $request){
        return DB::select(<<<EOF
            Select T0.Ejecutivo,T0.Cliente,T0.Sector,T0.Sucursal,SUM(T0.TotalUSD) as Total,MONTH(T0.FechaEstimadaCierre) as Mes,YEAR(T0.FechaEstimadaCierre) as Año
            From [192.168.10.31].H2_Levcorp.dbo.RPT_OPORTUNIDADES T0
            where MONTH(T0.FechaEstimadaCierre)=MONTH(GETDATE()) 
            and YEAR(T0.FechaEstimadaCierre) = YEAR(GETDATE()) 
            and T0.Sector='$request->Sector' 
            --and (T0.EstadoOportunidad ='Propuesta' or T0.EstadoOportunidad ='Negociacion')
            and convert(float,PExito1) >= 0.9
            and T0.Estado !='Cerrada'
            Group By T0.Ejecutivo,T0.Cliente,T0.Sector,T0.Sucursal,MONTH(T0.FechaEstimadaCierre),YEAR(T0.FechaEstimadaCierre)
            order By T0.Sucursal
        EOF);
    }
    public function handleGetOportunidadesAll(Request $request){
        return DB::select(<<<EOF
            Select T0.Ejecutivo,T0.Cliente,T0.Sector,T0.Sucursal,SUM(T0.TotalUSD) as Total,MONTH(T0.FechaEstimadaCierre) as Mes,YEAR(T0.FechaEstimadaCierre) as Año
            From [192.168.10.31].H2_Levcorp.dbo.RPT_OPORTUNIDADES T0
            where YEAR(T0.FechaEstimadaCierre) = YEAR(GETDATE()) 
            and MONTH(T0.FechaEstimadaCierre) > MONTH(GETDATE())
            and T0.Sector='$request->Sector'
            --and (T0.EstadoOportunidad ='Propuesta' or T0.EstadoOportunidad ='Negociacion')
            and T0.Estado !='Cerrada'
            and convert(float,PExito1) >= 0.9
            Group By T0.Ejecutivo,T0.Cliente,T0.Sector,T0.Sucursal,MONTH(T0.FechaEstimadaCierre),YEAR(T0.FechaEstimadaCierre)
            order By T0.Sucursal
        EOF);
    }
    public function handleGetOportunidadesMeses($sector){
        return DB::select(<<<EOF
            Select SUM(T0.TotalUSD) as Total,MONTH(T0.FechaEstimadaCierre) as Mes,YEAR(T0.FechaEstimadaCierre) as Año
            From [192.168.10.31].H2_Levcorp.dbo.RPT_OPORTUNIDADES T0
            where YEAR(T0.FechaEstimadaCierre) = YEAR(GETDATE()) 
            and MONTH(T0.FechaEstimadaCierre) > MONTH(GETDATE())
            and T0.Sector='$sector' 
            and T0.Estado !='Cerrada'
            --and (T0.EstadoOportunidad ='Propuesta' or T0.EstadoOportunidad ='Negociacion')
            and convert(float,PExito1) >= 0.9
            Group By MONTH(T0.FechaEstimadaCierre),YEAR(T0.FechaEstimadaCierre)        
        EOF);
    }
    public function handleGetOportunidadesAños($sector){
        return DB::select(<<<EOF
            Select SUM(T0.TotalUSD) as Total,YEAR(T0.FechaEstimadaCierre) as Año
            From [192.168.10.31].H2_Levcorp.dbo.RPT_OPORTUNIDADES T0
            where YEAR(T0.FechaEstimadaCierre) = YEAR(GETDATE()) 
            and MONTH(T0.FechaEstimadaCierre) > MONTH(GETDATE())
            and T0.Sector='$sector'
            and T0.Estado !='Cerrada'
            --and (T0.EstadoOportunidad ='Propuesta' or T0.EstadoOportunidad ='Negociacion')
            and convert(float,PExito1) >= 0.9
            Group By YEAR(T0.FechaEstimadaCierre)
        EOF);
    }
    public function handleGetOporunidadesDetalle(Request $request){
        return DB::select(<<<EOF
            select T0.Marca,T0.Cliente,T0.Ejecutivo,T0.DescripcionItem,T0.CodigoVenta,T0.CodigoVenta,T0.Cantidad,T0.TotalUSD 
            from [192.168.10.31].H2_Levcorp.dbo.RPT_OPORTUNIDADES T0
            where MONTH(T0.FechaEstimadaCierre)='$request->mes'
            and T0.Sector='$request->sector'
            and YEAR(T0.FechaEstimadaCierre)='$request->year'
            and T0.Cliente= '$request->cliente'
            and T0.Estado !='Cerrada'
            --and (T0.EstadoOportunidad ='Propuesta' or T0.EstadoOportunidad ='Negociacion')
            and convert(float,PExito1) >= 0.9
        EOF);
    }
}
