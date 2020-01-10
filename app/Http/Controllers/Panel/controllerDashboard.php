<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Response;
use App\Hana\SQL\Panel;

class controllerDashboard extends Controller
{
    public $Panel;
    public function __construct(){
      $this->Panel=new Panel();
    }
    public function handleGetPresupuesto(){
        $data=DB::select(<<<EOF
        select SUM(convert(int,T0.MONTO)) as MONTO,T0.MES
        from BI.dbo.PRESUPUESTO2020 T0
        --where T0.MERCADO='PEG'
        group BY T0.MES
        order BY case T0.MES when 'ENERO' then 1
                            when 'FEBRERO' then 2
                            when 'MARZO' then 3
                            when 'ABRIL' then 4
                            when 'MAYO' then 5
                            when 'JUNIO' then 6
                            when 'JULIO' then 7
                            when 'AGOSTO' then 8
                            when 'SEPTIEMBRE' then 9
                            when 'OCTUBRE' then 10
                            when 'NOVIEMBRE' then 11
                            when 'DICIEMBRE' then 12
                            END ASC
        EOF);
        $values=[];
        foreach ($data as $key => $value) {
            $values[$key ]=$value->MONTO;
        }
        return Response::json($values);
    }
    public function handleGetFacturacion(){
        $data = $this->Panel->getFacturacion();
        $values=[];
        foreach (\json_decode($data) as $key => $value) {
            $values[$key]=$value->TOTAL_FACTURACION;
        }
        return Response::json($values);
    }
    public function validateMercado($value){
        if($value=='CSS'){
            return 'C&SS';
        }else{
            if($value=='O&G'){
                return 'PEG';
            }else{
                return $value;
            }
        }
    }
    public function handleGetPresupuestoMercado($value){
        if($value=='General'){
            return $this->handleGetPresupuesto();
        }else{
            $mercado=$this->validateMercado($value);
            $data=DB::select(<<<EOF
                select SUM(convert(int,T0.MONTO)) as MONTO,T0.MES
                from BI.dbo.PRESUPUESTO2020 T0
                where T0.MERCADO='$mercado'
                group BY T0.MES
                order BY case T0.MES when 'ENERO' then 1
                                    when 'FEBRERO' then 2
                                    when 'MARZO' then 3
                                    when 'ABRIL' then 4
                                    when 'MAYO' then 5
                                    when 'JUNIO' then 6
                                    when 'JULIO' then 7
                                    when 'AGOSTO' then 8
                                    when 'SEPTIEMBRE' then 9
                                    when 'OCTUBRE' then 10
                                    when 'NOVIEMBRE' then 11
                                    when 'DICIEMBRE' then 12
                                    END ASC
            EOF);
            $values=[];
            foreach ($data as $key => $value) {
                $values[$key ]=$value->MONTO;
            }
            return Response::json($values);
        }
    }
    public function handleGetFacturacionMercado($value){
        if($value=='General'){
            return $this->handleGetFacturacion();
        }else{
            $data = $this->Panel->getFacturacionMercado($value);
            $values=[];
            foreach (\json_decode($data) as $key => $value) {
                $values[$key]=$value->TOTAL_FACTURACION;
            }
            return Response::json($values);
        }
    
    }
}