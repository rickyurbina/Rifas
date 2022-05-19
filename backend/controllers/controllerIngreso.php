<?php 
class ControllerIngreso {
  public static function ctrIngresar() {
    if (isset($_POST["cajaCorreo"])) {
      $datosController = array(
        "cajaCorreo" => $_POST["cajaCorreo"],
        "cajaPassword" => $_POST["cajaPassword"]
      );

      $respuesta = ModelIngreso::mdlIngresar($datosController);


      if ($_POST["cajaCorreo"] === $respuesta["email"] && password_verify($_POST["cajaPassword"], $respuesta["password"]) && $respuesta["activo"] === "S") {
        //session_start();
        if ( empty(session_id())) //session_start();
        $_SESSION["validar"] = true;
        $_SESSION["email"] = $respuesta["email"];
        $_SESSION["nombre"] = $respuesta["nombre"];
        $_SESSION["rol"] = $respuesta["rol"];

        header("location:views/inicio.php");
      } else {
        print_r("Usuario no registrado");
      }
    }
  }
}
