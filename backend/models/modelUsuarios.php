<?php
    require_once "conexion.php";
    class UsuarioModel {
        /*Función para agregar un usuario con vase en el arreglo "datosmodel"*/ 
        public static function mdlAgregarUsuario($datosModel) {
            $statement = Conexion::conectar() -> prepare("INSERT INTO `usuarios` VALUES (NULL,:usuario,:password,:nombre,:email,'',:rol,'',0,:activo);");
    
            $statement -> bindParam(":usuario",$datosModel["usuario"], PDO::PARAM_STR);
            $statement -> bindParam(":password",$datosModel["password"], PDO::PARAM_STR);
            $statement -> bindParam(":nombre",$datosModel["nombre"], PDO::PARAM_STR);
            $statement -> bindParam(":email",$datosModel["email"], PDO::PARAM_STR);
            $statement -> bindParam(":rol",$datosModel["rol"], PDO::PARAM_INT);
            $statement -> bindParam(":activo",$datosModel["activo"], PDO::PARAM_STR);

            if ($statement -> execute()) {
                return "success";
            } else {
                return "error";
            }
        }

        public static function mdlListaUsuarios($tabla){
            $statement = Conexion::conectar() -> prepare("SELECT * FROM $tabla"); 
            $statement -> execute();
            return $statement -> fetchAll();
        }

        public static function mdlBuscarUsuario($tabla,$id){
            $statement = Conexion::conectar() -> prepare(("SELECT `id`,`usuario`,`nombre`,`email`,`rol`,`activo` FROM `usuarios` WHERE id = :id"));
            $statement-> bindParam(":id",$id, PDO::PARAM_INT);
            if($statement -> execute()){
                return $statement->fetch();
            }else{
                return "error";
            }
        }

        public static function mdlActualizarUsuario($tabla,$datosModel){
            if($datosModel["password"] == ""){
                $statement = Conexion::conectar() -> prepare("UPDATE usuarios SET `usuario`=:usuario,`nombre`=:nombre,`email`=:email,`rol`=:rol, `activo`= :activo WHERE id = :id");
                
                $statement -> bindParam(":usuario",$datosModel["usuario"],PDO::PARAM_STR);
                $statement -> bindParam(":nombre", $datosModel["nombre"],PDO::PARAM_STR);
                $statement -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
                $statement -> bindParam(":rol",$datosModel["rol"], PDO::PARAM_INT);
                $statement -> bindParam(":activo", $datosModel["activo"], PDO::PARAM_STR);
                $statement -> bindParam(":id",$datosModel["id"],PDO::PARAM_INT);
                if($statement -> execute()){
                    return "success";
                }else{
                    return "error"; 
                }
            }else{
                $statement = Conexion::conectar() -> prepare("UPDATE usuarios SET `usuario`=:usuario,`password`=:password,`nombre`=:nombre,`email`=:email,`rol`=:rol,`activo`=:activo WHERE id = :id");
                
                $statement -> bindParam(":usuario",$datosModel["usuario"],PDO::PARAM_STR);
                $statement -> bindParam(":nombre", $datosModel["nombre"],PDO::PARAM_STR);
                $statement -> bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
                $statement -> bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
                $statement -> bindParam(":rol",$datosModel["rol"], PDO::PARAM_INT);
                $statement -> bindParam(":activo", $datosModel["activo"], PDO::PARAM_STR);
                $statement -> bindParam(":id",$datosModel["id"],PDO::PARAM_INT);
                if($statement -> execute()){
                    return "success";
                }else{
                    
                    print_r($statement -> error_log);
                    return "error"; 
                }
            }
        }

        public static function mdlBorrarUsuario($tabla,$id){
            $statement = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

            $statement -> bindParam(":id",$id,PDO::PARAM_INT);

            if($statement -> execute()){
                return "success";
            }else{
                return "error";
            }
        }
    }
?>
