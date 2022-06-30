<?php
    //require_once "conexion.php";
    class BoletosModel{

        public static function mdlBuscarNoBoleto($noBoleto){
            $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE noBoleto = :noBoleto AND idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`)");
        
            $statement -> bindParam(":noBoleto",$noBoleto,PDO::PARAM_INT);
        
            $statement -> execute();
        
            return $statement -> fetch();
        }

        public static function mdlBuscarBoletoPorSorteo($noBoleto, $idSorteo) {
          $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE noBoleto = :noBoleto AND idSorteo = :idSorteo;");
        
          $statement -> bindParam(":noBoleto", $noBoleto, PDO::PARAM_INT);
          $statement -> bindParam(":idSorteo", $idSorteo, PDO::PARAM_INT);

          $statement -> execute();
          return $statement -> fetch();
        }
        
        public static function mdlBuscaBoletos($tabla,$id){
            $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE idSorteo = :idSorteo ORDER BY noBoleto ASC ");

            $statement -> bindParam(":idSorteo",$id,PDO::PARAM_INT);
            $statement -> execute();
            return $statement -> fetchAll();
        }

        public static function mdlAgregarBoleto($datosModel){
            $statement = Conexion::conectar() -> prepare("INSERT INTO `boletos` VALUES (NULL,:idSorteo,:nombre,:telefono,:estado,:email,:noBoleto,:status,:fecha, :fechaPago, :horaApartado, :horaPagado);");
            
            $statement -> bindParam(":idSorteo",$datosModel["idSorteo"],PDO::PARAM_INT);
            $statement -> bindParam(":nombre",$datosModel["nombre"], PDO::PARAM_STR);
            $statement -> bindParam(":telefono",$datosModel["telefono"], PDO::PARAM_STR);
            $statement -> bindParam(":estado",$datosModel["estado"], PDO::PARAM_STR);
            $statement -> bindParam(":email",$datosModel["email"],PDO::PARAM_STR);
            $statement -> bindParam(":noBoleto",$datosModel["noBoleto"],PDO::PARAM_INT);
            $statement -> bindParam(":status",$datosModel["status"], PDO::PARAM_STR_CHAR);
            $statement -> bindParam(":fecha",$datosModel["fecha"], PDO::PARAM_STR);
            $statement -> bindParam(":fechaPago",$datosModel["fechaPago"], PDO::PARAM_STR);
            $statement -> bindParam(":horaApartado",$datosModel["horaApartado"], PDO::PARAM_STR);
            $statement -> bindParam(":horaPagado",$datosModel["horaPagado"], PDO::PARAM_STR);
            

            if($statement -> execute()){
                return "success";
            }else {
                return $statement  -> errorInfo();
            }
        }

        public static function mdlActualizarBoleto($datosModel, $fechaApartado, $fechaPagado, $horaApartado, $horaPagado) {

            $statement = Conexion::conectar() -> prepare("UPDATE `boletos` SET `nombre`= :nombre, `telefono` = :telefono, `email` = :email, `estado` = :estado, `status` = :s, `fecha`= '$fechaApartado', `fechaPago`= '$fechaPagado', `horaApartado` = '$horaApartado', `horaPagado` = '$horaPagado'  WHERE `noBoleto` = :noBoleto AND `idSorteo` = :idSorteo;");
          
            $statement -> bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
            $statement -> bindParam(":telefono", $datosModel["telefono"], PDO::PARAM_STR);
            $statement -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
            $statement -> bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
            $statement -> bindParam(":s", $datosModel["status"], PDO::PARAM_STR);
            $statement -> bindParam(":noBoleto", $datosModel["noBoleto"], PDO::PARAM_INT);
            $statement -> bindParam(":idSorteo", $datosModel["idSorteo"], PDO::PARAM_INT);
            
            if ($statement -> execute()) {
              return "success";
            } else {
              return "error";
            }
        }

        public static function mdlObtenerSorteoActual(){
            $statement = Conexion::conectar() -> prepare("SELECT * FROM `sorteos` WHERE idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`) LIMIT 1;");

            $statement -> execute();
            return $statement -> fetch();
        }

       public static function mdlObtenerBoletosVendidos(){
           $statement = Conexion::conectar() ->prepare("SELECT COUNT(idBoleto) as numeroBoletos FROM `boletos` as ingresos WHERE idSorteo = (SELECT MAX(idSorteo) FROM `sorteos`)");
           
           $statement -> execute();

           return $statement -> fetch();
       }

        public static function mdlBuscarBoletosVendidos($idSorteo){
            $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE `idSorteo` = :id AND `status` != 'N' ");

            $statement -> bindParam(":id",$idSorteo,PDO::PARAM_INT);

            $statement -> execute();

            return $statement ->  fetchAll();
        }
        public static function mdlBuscarBoletosPendientes($idSorteo){
            $statement = Conexion::conectar() -> prepare("SELECT * FROM `boletos` WHERE `idSorteo` = :id AND `status` = 'N' ");

            $statement -> bindParam(":id",$idSorteo,PDO::PARAM_INT);

            $statement -> execute();

            return $statement ->  fetchAll();
        }

        public static function mdlCompletarBoleto($idBoleto){

            $statement = Conexion::conectar() -> prepare("UPDATE `boletos` SET `status`='P', fechaPago=current_date(), horaPagado = :horaPagado WHERE `idBoleto` = :id;");

            $statement -> bindParam(":id",$idBoleto,PDO::PARAM_INT);
            date_default_timezone_set("America/Chihuahua");
            $statement -> bindParam(":horaPagado", date("H:i:s"), PDO::PARAM_STR);

            if($statement -> execute()){
                return "success";
            } else {
                return "error";
            }
        }

        public static function mdlBorrarBoleto($idBoleto){
            $statement = Conexion::conectar() -> prepare("DELETE FROM `boletos` WHERE idBoleto=:id");

            $statement -> bindParam(":id",$idBoleto,PDO::PARAM_INT);

            if($statement -> execute()){
                return "success";
            }else {
                return "error";
            }
        }
    }
