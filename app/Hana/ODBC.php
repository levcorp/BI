<?php
namespace App\Hana;
use PDO;
use Response;
use Exception;
use Config;
class ODBC{
  public $connect;
  public function __construct(){
    $this->connect = odbc_connect("Driver=".Config::get('database.connections.HANA.driver').";ServerNode=".Config::get('database.connections.HANA.server').";Database=".Config::get('database.connections.HANA.database').";CHAR_AS_UTF8=true", Config::get('database.connections.HANA.username'),Config::get('database.connections.HANA.password'),SQL_CUR_USE_ODBC);
  }
  public function query($sql){
    if (!($this->connect)){
        return "Falló la conexión a la base de datos a través de ODBC:";
      }else{
          $result = odbc_exec($this->connect, $sql);
          $data = array();
          $count=0;
          while ($row = odbc_fetch_array($result)) {
             $data[$count] = $row;
             $count++;
           }
          return json_encode($data);
      }
  }
  public function procedure_void($sql){
    if (!($this->connect)){
        return "Falló la conexión a la base de datos a través de ODBC:";
      }else{
          $result = odbc_exec($this->connect, $sql);
          return "Realizado";
      }
  }
}
   