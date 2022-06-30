<div class="container-fluid">
  <div class="row justify-content-center" id="container-consulta">
    <div class="col-md-6 col-lg-6 col-12">
      <div class="card">
        <div class="card-header">
          <h5>Venta de Boletos</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
            <label for="col-form-label pt-0" for="cajaNombreCliente">Numero de Boleto:</label>
              <input type="text" class="form-control" id="cajaBoleto">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col">
              <button class="btn btn-secondary btn-block" type="button" onclick="consultarBoleto()">Buscar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="display: none;" id="container-editar">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5>Venta de Boletos</h5>
        </div>
        <div class="card-body">
          <form method="POST" id="editarBoletoForm" class="theme-form">
            <div class="row">
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label for="col-form-label pt-0" for="cajaNombreCliente">Nombre del cliente:</label>
                  <input type="text" name="cajaNombreCliente" id="cajaNombreCliente" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaTelefonoCliente">Telefono Cliente: *</label>
                  <input type="text" name="cajaTelefonoCliente" minlength="10" maxlength="10" id="cajaTelefonoCliente" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaEmailUsuario">Email:</label>
                  <input type="email" name="cajaEmailUsuario" id="cajaEmailUsuario" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label for="cajaNoBoleto">No Boleto: *</label>
                  <input type="text" name="cajaNoBoleto" id="cajaNoBoleto" required class="form-control" disabled>
                  <input type="text" name="cajaNoBoleto2" id="cajaNoBoleto2" required class="form-control" hidden>
                  <small><span id="spanBoletos"></span></small>
                </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label for="cajaEstadoUsuario">Estado: *</label>
                  <select class="form-control digits" id="cajaEstadoUsuario" name="cajaEstadoUsuario" required>
                    <option value="">Seleccione un estado</option>
                    <option value="Estados Unidos">Estados Unidos</option>
                    <option value="Aguascalientes">Aguascalientes</option>
                    <option value="Baja California">Baja California</option>
                    <option value="Baja California Sur">Baja California Sur</option>
                    <option value="Campeche">Campeche</option>
                    <option value="Ciudad de Mexico">Ciudad de México</option>
                    <option value="Coahuila">Coahuila</option>
                    <option value="Colima">Colima</option>
                    <option value="Chiapas">Chiapas</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Durango">Durango</option>
                    <option value="Estado de Mexico">Estado de México</option>
                    <option value="Guanajuato">Guanajuato</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                    <option value="Jalisco">Jalisco</option>
                    <option value="Michoacan">Michoacán</option>
                    <option value="Morelos">Morelos</option>
                    <option value="Nayarit">Nayarit</option>
                    <option value="Nuevo Leon">Nuevo León</option>
                    <option value="Oaxaca">Oaxaca</option>
                    <option value="Puebla">Puebla</option>
                    <option value="Queretaro">Querétaro</option>
                    <option value="Quintana Roo">Quintana Roo</option>
                    <option value="San Luis Potosi">San Luis Potosí</option>
                    <option value="Sinaloa">Sinaloa</option>
                    <option value="Sonora">Sonora</option>
                    <option value="Tabasco">Tabasco</option>
                    <option value="Tamaulipas">Tamaulipas</option>
                    <option value="Tlaxcala">Tlaxcala</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Yucatán">Yucatán</option>
                    <option value="Zacatecas">Zacatecas</option>   
                  </select>
                </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label for="cajaStatusVenta">Estado del boleto:</label>
                  <select class="form-control digits" id="cajaStatusVenta" name="cajaStatusVenta" >
                      <option value="P">Pagado</option>
                      <option value="N" selected >No pagado</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-md-3 col-lg-3 col-12">
                <div class="form-group">
                  <label for="col-form-label pt-0" for="cajafechaApartado">Fecha Apartado:</label>
                  <input type="date" name="cajafechaApartado" id="cajafechaApartado" class="form-control">
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajahoraApartado">Hora Apartado</label>
                  <input type="text" name="cajahoraApartado" id="cajahoraApartado" class="form-control">
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajafechaPagado">Fecha Pagado: *</label>
                  <input type="date" name="cajafechaPagado" id="cajafechaPagado" class="form-control" >
                </div>
              </div>
              <div class="col-md-3 col-lg-3 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajahoraPagado">Hora Pagado</label>
                  <input type="text" name="cajahoraPagado" id="cajahoraPagado" class="form-control">
                </div>
              </div>
            </div> -->
            <div class="row justify-content-center">
              <div class="col-md-3 col-lg-3 col-6">
                <button class="btn btn-warning btn-block" type="button" onclick="window.location.reload()">Cancelar</button>
              </div>
              <div class="col-md-3 col-lg-3 col-6">
                <button class="btn btn-secondary btn-block" type="submit" id="btnGuardar">Guardar</button>
              </div>

            </div>
          </form>
          <?php
          $controllerBoletos = new BoletosController();
          //$controllerBoletos -> ctrActualizarBoleto();
          $controllerBoletos -> ctrAgregaBoleto();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const cajaBoleto = document.getElementById('cajaBoleto');
  const btnGuardar = document.getElementById('btnGuardar');
  //btnGuardar.disabled=true;

  function consultarBoleto() {
    if (cajaBoleto.value) {
      if (!isNaN(cajaBoleto.value)) {

        const data = new FormData();
        data.set("noBoleto", cajaBoleto.value);

        $.ajax({
          url: '../controllers/comprobarBoleto.php',
          type: 'POST',
          data: data,
          success: (response) => {
            const boleto = JSON.parse(response);
            if (boleto) {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El Boleto ya está vendido'
              })
                            
            } else {
              console.log(boleto);
              calcularBoletos(cajaBoleto.value);
               document.getElementById('container-consulta').style.display = 'none';
               document.getElementById('container-editar').style.display = 'flex';

              // document.getElementById('cajaNombreCliente').value = boleto.nombre;
              // document.getElementById('cajaTelefonoCliente').value = boleto.telefono;
              // document.getElementById('cajaEmailUsuario').value = boleto.email;
               document.getElementById('cajaNoBoleto').value = cajaBoleto.value;
               document.getElementById('cajaNoBoleto2').value = cajaBoleto.value;
              // document.getElementById('cajaEstadoUsuario').value = boleto.estado;
              // document.getElementById('cajaStatusVenta').value = boleto.status;
              // document.getElementById('cajafechaApartado').value = boleto.fecha;
              // document.getElementById('cajafechaPagado').value = boleto.fechaPago;
              // document.getElementById('cajahoraApartado').value = boleto.horaApartado;
              // document.getElementById('cajahoraPagado').value = boleto.horaPagado;
            }
          },
          error: (error) => {
            console.log(error);
          },
          complete: () => {},
          cache: false,
          contentType: false,
          processData: false
        });
      } else {
        Swal.fire({
          icon: 'error',
          text: 'Escriba solamente numeros'
        });
      }
    } else {
      Swal.fire({
        icon: 'error',
        text: 'Escriba el numero de boleto que desea buscar'
      });
    }
  }

  function calcularBoletos(noBoleto) {
    const spanBoletos = document.getElementById('spanBoletos');
    const numero = Number.parseInt(noBoleto);
    if (numero >= 1 && numero <= 5000) {
      spanBoletos.innerHTML = `Boletos: ${20001 - numero}, ${numero + 35000}, ${55001 - numero}`;
    } else if (numero >= 5001 && numero < 10000) {
      spanBoletos.innerHTML = `Boletos: ${25000 - (numero - 5001)}, ${numero + 25000}, ${50000 - (numero - 5001)}`;
    } else if (numero >= 10001 && numero <= 15000) {
      spanBoletos.innerHTML = `Boletos: ${30000 - (numero - 10001)}, ${numero + 30000}, ${60000 - (numero - 10001)}`;
    }
    else{
      btnGuardar.disabled=true;
      spanBoletos.className += "alert alert-danger";
      spanBoletos.innerHTML = `Numero invalido para este sorteo`;
    }
  }
</script>