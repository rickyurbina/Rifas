<?php 
session_start();
class ControllerIngreso {
  public static function ctrIngresar() {
    
    if (isset($_POST["cajaCorreo"])) {
      $datosController = array(
        "cajaCorreo" => $_POST["cajaCorreo"],
        "cajaPassword" => $_POST["cajaPassword"]
      );

      $respuesta = ModelIngreso::mdlIngresar($datosController);


      if ($_POST["cajaCorreo"] === $respuesta["email"] 
                  && password_verify($_POST["cajaPassword"], $respuesta["password"]) 
                  && $respuesta["activo"] === "S") 
      {
        $_SESSION["validar"] = true;
        $_SESSION["email"] = $respuesta["email"];
        $_SESSION["nombre"] = $respuesta["nombre"];
        $_SESSION["rol"] = $respuesta["rol"];

        //Uso la redireccion de JS para evitar el error de headers already be sent de php
        echo "<script> window.location='views/inicio.php'; </script>";
        exit();
      } else {
        session_destroy();
        print_r("Usuario o password incorrecto");
      }
    }
  }
}
