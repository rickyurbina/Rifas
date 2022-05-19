<div class="container-fluid">
  <div class="row justify-content-center" id="container-consulta">
    <div class="col-md-6 col-lg-6 col-12">
      <div class="card">
        <div class="card-header">
          <h5>No. Boleto</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col">
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
          <h5>Editar boleto</h5>
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
            <div class="row justify-content-center">
              <div class="col-8">
                <button class="btn btn-secondary btn-block" type="submit">Guardar</button>
              </div>
            </div>
          </form>
          <?php
          $controllerBoletos = new BoletosController();
          $controllerBoletos -> ctrActualizarBoleto();
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const cajaBoleto = document.getElementById('cajaBoleto');

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
              console.log(boleto);
              calcularBoletos(cajaBoleto.value);
              document.getElementById('container-consulta').style.display = 'none';
              document.getElementById('container-editar').style.display = 'flex';

              document.getElementById('cajaNombreCliente').value = boleto.nombre;
              document.getElementById('cajaTelefonoCliente').value = boleto.telefono;
              document.getElementById('cajaEmailUsuario').value = boleto.email;
              document.getElementById('cajaNoBoleto').value = cajaBoleto.value;
              document.getElementById('cajaNoBoleto2').value = cajaBoleto.value;
              document.getElementById('cajaEstadoUsuario').value = boleto.estado;
              document.getElementById('cajaStatusVenta').value = boleto.status;
                            
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Boleto no encontrado'
              })
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
          text: 'Inserte un número de boleto válido'
        });
      }
    } else {
      Swal.fire({
        icon: 'error',
        text: 'Inserte un número de boleto válido'
      });
    }
  }

  function calcularBoletos(noBoleto) {
    const spanBoletos = document.getElementById('spanBoletos');
    const numero = Number.parseInt(noBoleto);
    if (numero >= 1 && numero < 668) {
      spanBoletos.innerHTML = `Boletos: ${numero + 2000}, ${numero + 4667}, ${numero + 6667}, ${numero + 8000}`;
    } else if (numero >= 668 && numero < 1335) {
      spanBoletos.innerHTML = `Boletos: ${numero + 2000}, ${numero + 3333}, ${numero + 5333}, ${numero + 8000}`;
    } else if (numero >= 1335) {
      spanBoletos.innerHTML = `Boletos: ${numero + 2000}, ${numero + 4000}, ${numero + 6000}, ${numero != 2000 ? numero + 8000 : '0000'}`;
    }
  }
</script>