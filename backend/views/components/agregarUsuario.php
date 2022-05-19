<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5>Agregar usuario</h5>
        </div>
        <div class="card-body">

          <form class="theme-form" method="POST">
            <div class="row">
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaNombreUsuario">Nombre del usuario:</label>
                  <input type="text" name="cajaNombreUsuario" id="cajaNombreUsuario" class="form-control">
                </div>
              </div>
                <div class="col-md-4 col-lg-4 col-12">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="cajaNombreCompleto">Nombre completo:</label>
                        <input type="text" name="cajaNombreCompleto" id="cajaNombreCompleto" class="form-control">
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-12">
                    <div class="form-group">
                        <label class="col-form-label pt-0" for="cajaEmailUsuario">email:</label>
                        <input type="email" name="cajaEmailUsuario" id="cajaEmailUsuario" class="form-control">
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
                        <select class="form-control digits" id="cajaRolUsuario" name="cajaRolUsuario">
                            <option value="0">Administrador</option>
                            <option value="1">Usuario</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-12">
                    <div class="form-group">
                        <label for="cajaEstadoUsuario">Estado:</label>
                        <select class="form-control digits" id="cajaEstadoUsuario" name="cajaEstadoUsuario">
                            <option value="S">Activo</option>
                            <option value="N">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-8">
                <button class="btn btn-secondary btn-block">Guardar</button>
              </div>
            </div>
            <?php
                $controllerUsuarios = new UsuariosController();
                $controllerUsuarios -> ctrAgregarUsuario();
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>