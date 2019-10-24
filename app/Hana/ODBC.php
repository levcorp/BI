<?php
namespace App\Hana;
use PDO;
use Response;
use Exception;
class ODBC{
  public $connect;
  public function __construct(){
    $this->connect = odbc_connect("Driver=".env('DB_HANA_DRIVER').";ServerNode=".env('DB_HANA_SERVERNAME').";Database=".env('DB_HANA_DATABASE').";CHAR_AS_UTF8=true", env('DB_HANA_USERNAME'),env('DB_HANA_PASSWORD'),SQL_CUR_USE_ODBC);
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
}
