<?php
namespace App\Hana\SQL;
use App\Hana\ODBC;
use Response;
use DateTime;

class DMI extends ODBC{
public function truncate(){
    $fecha1 = new DateTime(now());//fecha inicial
    $truncateH=<<<EOF
     	truncate table "DMI"."EDI852_H";
    EOF;
    if(parent::procedure_void(utf8_decode($truncateH))=='Realizado')
    {
      $truncateSCO=<<<EOF
         truncate table "DMI"."EDI852_SCO";
      EOF;
      if(parent::procedure_void(utf8_decode($truncateSCO))=='Realizado'){
        $truncateSLP=<<<EOF
           truncate table "DMI"."EDI852_SLP";
        EOF;
        if(parent::procedure_void(utf8_decode($truncateSLP))=='Realizado'){
          $truncateSSC=<<<EOF
             truncate table "DMI"."EDI852_SSC";
          EOF;
          if(parent::procedure_void(utf8_decode($truncateSSC))=='Realizado'){
            $fecha2 = new DateTime(now());//fecha de cierre
            $intervalo = $fecha1->diff($fecha2);
            return  ' Tiempo de ejecución: '.$intervalo->format('%i minutos %s segundos');
          }else{
            return "Fallo en truncate table EDI852_SSC";
          }
        }else{
          return "Fallo en truncate table EDI852_SLP";
        }  
      }else{
        return "Fallo en truncate table EDI852_SCO";
      }
    }else{
      return "Fallo en truncate table EDI852_H";
    }
  }
  public function call(){
    $fecha1 = new DateTime(now());//fecha inicial
    $CallCO=<<<EOF
     	Call "DMI"."SPOKE_CO";
    EOF;
    if(parent::procedure_void(utf8_decode($CallCO))=='Realizado')
    {
      $CallSC=<<<EOF
        call "DMI"."SPOKE_SC";
      EOF;
      if(parent::procedure_void(utf8_decode($CallSC))=='Realizado'){
        $CallLP=<<<EOF
           call "DMI"."SPOKE_LP"
        EOF;
        if(parent::procedure_void(utf8_decode($CallLP))=='Realizado'){
          $CallH=<<<EOF
            call "DMI"."SPOKE_H";
          EOF;
          if(parent::procedure_void(utf8_decode($CallH))=='Realizado'){
            $fecha2 = new DateTime(now());//fecha de cierre
            $intervalo = $fecha1->diff($fecha2);
            return  ' Tiempo de ejecución: '.$intervalo->format('%i minutos %s segundos');
          }else{
            return "Fallo en call SPOKE_H";
          }
        }else{
          return "Fallo en call SPOKE_LP";
        }  
      }else{
        return "Fallo en call SPOKE_SC";
      }
    }else{
      return "Fallo en call SPOKE_CO";
    }
  }
}