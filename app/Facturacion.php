<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    protected $table='FACTURACION';

    protected $appends = ['MesFaLiteral','MesOVALiteral','MesCierreLiteral','MesFaAnteriorLiteral','Total'];

    public function getMesFaLiteralAttribute(){
        return $this->mes($this->attributes['MESFA']);
    }
    public function getMesOVALiteralAttribute(){
        return $this->mes($this->attributes['MESOVA']);
    }
    public function getMesCierreLiteralAttribute(){
        return $this->mes($this->attributes['MESCIERRE']);
    }
    public function getMesFaAnteriorLiteralAttribute(){
        return $this->mes( (int) $this->attributes['MESCIERRE']-1);
    }
    public function getTotalAttribute(){
        return  (float) $this->attributes['TOTAL_FACTURAS']+ 
                (float) $this->attributes['TOTAL_FACTURASA']+
                (float) $this->attributes['TOTAL_OVA']+
                (float) $this->attributes['TOTAL_OV']+
                (float) $this->attributes['OPORTUNIDADESTOTAL_MES']+
                (float) $this->attributes['OPORTUNIDADESTOTAL_GESTION'];
    }
    public function mes($mes){
        switch ($mes) {
            case '1':
                return 'Enero';
            break;
            case '2':
                return 'Febrero';
            break;
            case '3':
                return 'Marzo';
            break;
            case '4' :
                return 'Abril';
            break;
            case '5':
                return 'Mayo';
            break;
            case '6':
                return 'Junio';
            break;
            case '7':
                return 'Julio';
            break;
            case '8':
                return 'Agosto';
            break;
            case '9':
                return 'Septiembre';
            break;
            case '10':
                return 'Octubre';
            break;
            case '11':
                return 'Noviembre';
            break;
            case '12':
                return 'Diciembre';
            break;
        }
    }
}
