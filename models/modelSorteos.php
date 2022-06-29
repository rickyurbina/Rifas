<?php
   //require "./conexion.php";
  class ModelSorteos {
      public static function mdlBuscarSorteoActual() {
          $statement = Conexion::conectar() -> prepare("SELECT * FROM `sorteos` ORDER by `idSorteo` DESC");

          $statement -> execute();

          return $statement -> fetchAll();
      }

      public static function mdlObtenerSorteoActivo() {
        $statement = Conexion::conectar() -> prepare("SELECT * FROM `sorteos` WHERE idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`) LIMIT 1;");

        $statement -> execute();

        return $statement -> fetch();
      }

      public static function mdlBuscaFotoSorteo(){
        $statement = Conexion::conectar() -> prepare("SELECT fotos FROM `sorteos` WHERE idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`) LIMIT 1;");        
        $statement -> execute();
        return $statement -> fetch();
      }
  }
