<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Hana\ODBC;
use Response;
use App\AsignacionAlmacen;
use App\ListaAlmacen;
use App\Hana\SQL\Almacen;
use App\ArticulosAlmacen;
class FabricanteAsignacion extends Model
{
    protected $table='FABRICANTE_ASIGNACION';
    protected $fillable=[
      'COD_FABRICANTE',
      'ASIGNACION_ID',
      'FABRICANTE'
    ];
    public $timestamps=false;
    protected $appends = ['COUNT_ARTICULOS','COUNT_ARTICULOS_CHECK'];
    public function setFabricanteAttribute($value){
        $ODBC=new ODBC();
        $sql=<<<EOF
        select T1."FirmName" from LEVCORP.OMRC T1 where T1."FirmCode" = '$value'
        EOF;
        $resultado=$ODBC->query(utf8_decode($sql));
        foreach (json_decode($resultado) as $val) {
          return $this->attributes['FABRICANTE'] = $val->FirmName;
        }
    }
    public function asignacion(){
      return $this->belongsTo(AsignacionAlmacen::class,'ASIGNACION_ID');
    }
    public function getCOUNTARTICULOSAttribute(){
      try {
        $Almacen=new Almacen();
        $asigAlmacen=AsignacionAlmacen::findOrFail($this->attributes['ASIGNACION_ID']);
        $usuario=User::findOrFail($asigAlmacen->USUARIO_ID);
        $usuario->sucursal_id;
        $sucursal=$Almacen->WhsCode($usuario->sucursal_id);
          $resultado=$Almacen->countArticulos($this->attributes['COD_FABRICANTE'],$sucursal);
          foreach (json_decode($resultado) as $val) {
            return $val->COUNTARTICULOS;
          }
      } catch (\Exception $e) {
        return "S/N";
      }
    }
    public function getCOUNTARTICULOSCHECKAttribute(){
      try {
        $count=ArticulosAlmacen::where('FABRICANTE_ASIGNACION_ID',$this->attributes['id'])->count();
        return $count;
      } catch (\Exception $e) {
        return "S/N";
      }
    }
}
