<?php
    class UsuariosController {
        public function ctrBuscarMiUsuario(){
            //print_r($_SESSION['nombre']);
            
            echo'
                <div class="media-body"><span>'. 'Administrador' .'</span>
                    <p class="mb-0 font-roboto">Admin<i class="middle fa fa-angle-down"></i></p>
                </div>
            ';
            
        }

        public function ctrAgregarUsuario(){
            if(isset($_POST['cajaNombreUsuario'])){
                $password = password_hash($_POST["cajaClaveUsuario"],PASSWORD_DEFAULT);
                $datosController = array(
                    "usuario" => $_POST["cajaNombreUsuario"],
                    "password" => $password,
                    "nombre" => $_POST["cajaNombreCompleto"],
                    "email" => $_POST["cajaEmailUsuario"],
                    "rol" => $_POST["cajaRolUsuario"],
                    "activo" => $_POST["cajaEstadoUsuario"]
                );
                $respuesta = UsuarioModel::mdlAgregarUsuario($datosController);
                if ($respuesta === "success") {
                    echo "
                    <script>
                      Swal.fire({
                        title: 'Usuario agregado exitosamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F73164'
                      }).then((value) => {
                        window.location.href = 'inicio.php?action=lstUsuarios';
                      });
                    </script>
                    ";
                } else {
                    echo "
                    <script>
                      Swal.fire({
                        title: 'Error al agregar el usuario',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F73164'
                      });
                    </script>
                    ";
                }
            }
        }

        public function ctrListarUsuarios(){
          $respuesta = UsuarioModel::mdlListaUsuarios("usuarios");
          foreach ($respuesta as $row => $item){
            echo '
              <tr>
                <td>'.$item["nombre"].'</td>
                <td>'.$item["email"].'</td>
                <td>'.($item["activo"] == "S" ? ('Activo') : ('Inactivo')).'</td>
                <td>
                  <a  class="btn btn-primary" href="inicio.php?action=uptUsuario&idEdita='.$item["id"].'"> <i class="fas fa-pencil-alt" style="font-size: 12px"> </i></a>
                  <a class="btn btn-secondary" href="inicio.php?action=lstUsuarios&idBorrar='.$item["id"].'"> <i class="fas fa-trash-alt" style="font-size: 12px"> </i></a>
                </td>
              </tr>
            ';
          }
        }
        //9013.32
        public function ctrActualizaUsuario($id){
          if(isset($_POST['actualizar'])){
            print_r('<script>console.log("'.$_POST['cajaClaveUsuario'].'")</script>');
            $password = "";
            if($_POST["cajaClaveUsuario"] != ""){
              $password = password_hash($_POST["cajaClaveUsuario"],PASSWORD_DEFAULT);
            }
            $datosController = array(
                "usuario" => $_POST["cajaNombreUsuario"],
                "password" => $password,
                "nombre" => $_POST["cajaNombreCompleto"],
                "email" => $_POST["cajaEmailUsuario"],
                "rol" => $_POST["cajaRolUsuario"],
                "activo" => $_POST["cajaEstadoUsuario"],
                "id" => $id
            );
            $respuesta =UsuarioModel::mdlActualizarUsuario("usuarios",$datosController);
            if ($respuesta === "success") {
              echo "
              <script>
                Swal.fire({
                  title: 'Usuario actualizado exitosamente',
                  icon: 'success',
                  confirmButtonText: 'Aceptar',
                  confirmButtonColor: '#F73164'
                }).then((value) => {
                  window.location.href = 'inicio.php?action=lstUsuarios';
                });
              </script>
              ";
            } else {
                echo "
                <script>
                  Swal.fire({
                    title: 'Error al actualizar el usuario',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#F73164'
                  });
                </script>
                ";
            }
          }
        }

        public function ctrBuscarUsuario($id){
          $respuesta = UsuarioModel::mdlBuscarUsuario("usuarios",$id);

          $rol = "";
          $rol = $respuesta["rol"] != 0 ? ('Selected') : ('');

          $activo = "";
          $activo = $respuesta["activo"] == "N" ? ('Selected') : (''); 
          echo '
            <div class="row">
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaNombreUsuario">Nombre del usuario:</label>
                  <input type="text" value="'.$respuesta["usuario"].'" name="cajaNombreUsuario" id="cajaNombreUsuario" class="form-control">
                </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                  <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaNombreCompleto">Nombre completo:</label>
                      <input value = "'.$respuesta["nombre"].'" type="text" name="cajaNombreCompleto" id="cajaNombreCompleto" class="form-control">
                  </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                  <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaEmailUsuario">email:</label>
                      <input value="'.$respuesta["email"].'" type="email" name="cajaEmailUsuario" id="cajaEmailUsuario" class="form-control">
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-lg-4 col-12">
                  <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaClaveUsuario">Contraseña:</label>
                      <input type="password" name="cajaClaveUsuario" id="CajaClaveUsuario" class="form-control">
                  </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                  <div class="form-group">
                      <label for="cajaRolUsuario">Rol del usuario:</label>
                      <select  class="form-control digits" id="cajaRolUsuario" name="cajaRolUsuario">
                          <option value="0">Administrador</option>
                          <option value="1" '.$rol.'>Usuario</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                  <div class="form-group">
                      <label for="cajaEstadoUsuario">Estado:</label>
                      <select class="form-control digits" id="cajaEstadoUsuario" name="cajaEstadoUsuario">
                          <option value="S" >Activo</option>
                          <option value="N" '.$activo.'>Inactivo</option>
                      </select>
                  </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-8">
                <button class="btn btn-secondary btn-block" name="actualizar" value="Actualizar">Actualizar</button>
              </div>
            </div>
          ';
        }


        public function ctrBorrarUsuario(){
          if(isset($_GET["idBorrar"])){
            $respuesta = UsuarioModel::mdlBorrarUsuario("usuarios",$_GET["idBorrar"]);

            if ($respuesta === "success") {
              echo "
              <script>
                Swal.fire({
                  title: 'Usuario eliminado exitosamente',
                  icon: 'success',
                  confirmButtonText: 'Aceptar',
                  confirmButtonColor: '#F73164'
                }).then((value) => {
                  window.location.href = 'inicio.php?action=lstUsuarios';
                });
              </script>
              ";
            } else {
                echo "
                <script>
                  Swal.fire({
                    title: 'Error al borrar el usuario',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#F73164'
                  });
                </script>
                ";
            }
          }
        }
    }

    
?>