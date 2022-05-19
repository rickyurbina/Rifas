<?php
class Conexion {
  public static function conectar() {
    $servername = "localhost";
    $username = "root";
    $password = "12345678";
    $dbname = "rifas";

    // $servername = "mysql1007.mochahost.com";
    // $username = "rickurbi_rifas";
    // $password = "w@5;_bv*XhFN";
    // $dbname = "rickurbi_rifas";

    try {
      $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      //echo "<script>alert('Acceso Correcto');</script>";
    } catch (PDOException $exception) {
      echo "<script>alert('".$exception->getMessage()."');</script>";
    }
    return $conexion;

  }
}
