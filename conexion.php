<?php

class Conexion {
  public static function conectar() {
    // $servername = "127.0.0.1";
    // $username = "root";
    // $password = "";
    // $dbname = "rifas";

    $servername = "mysql1007.mochahost.com";
    $username = "rickurbi_rifas";
    $password = "w@5;_bv*XhFN";
    $dbname = "rickurbi_rifas";

    try {
      $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOException $exception) {
        echo "<script>alert('Error '.$exception->getMessage());</script>";
    }
    return $conexion;
  }
}