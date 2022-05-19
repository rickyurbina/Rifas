<!DOCTYPE html>
<html dir="ltr">
<script src="https://sdk.mercadopago.com/js/v2"></script>

<?php
  include "./components/head.php";
  require_once "./controllers/controllerBoletos.php";
  require_once "./models/modelBoletos.php";

  require_once "./controllers/controllerCompras.php";
  require_once "./models/modelCompras.php";

  require_once "./controllers/controllerSorteos.php";
  require_once "./models/modelSorteos.php";

  if (isset($_GET["noBoleto"])) {
    $controllerSorteos = new SorteosController();
    $sorteo = $controllerSorteos -> ctrObtenerSorteoActivo();

    $idSorteo = $sorteo['idSorteo'];

    $noBoleto = $_GET["noBoleto"];

    if ($noBoleto > $sorteo['noBoletos']) {
      echo '<script>window.location.href = "boletos.php"</script>';
    }


    $controllerBoletos = new BoletosController();
    $respuesta = $controllerBoletos -> ctrComprobarBoletoDisponible($noBoleto, $idSorteo);
    if ($respuesta === "false") {
      echo '<script>window.location.href = "index.php"</script>';
    }
  } else {
      echo '<script>window.location.href = "index.php"</script>';
  }

  // generarNumeroReal();
  // generarOportunidades($noBoleto);
  function generarNumeroReal($noBoleto) {
    $cuantosCeros = 4 - count($noBoleto);
    
    $nuevoNumero = "";

    for ($i = 0; $i < $cuantosCeros; $i++) {
      $nuevoNumero = $nuevoNumero . "0";
    }

    $nuevoNumero = $nuevoNumero .  join($noBoleto);

    return $nuevoNumero;
  }

  function generarOportunidades($noBoleto) {
    $boletos = "";

    if ($noBoleto >= 1 && $noBoleto < 668) {
      $boletos = generarNumeroReal(str_split(strval($noBoleto))) . " - " . ($noBoleto + 2000) . " - " . ($noBoleto + 4667) . " - " . ($noBoleto + 6667) . " - " . ($noBoleto + 8000); 
    } else if ($noBoleto >= 668 && $noBoleto < 1335) {
      $boletos = generarNumeroReal(str_split(strval($noBoleto))) . " - " . ($noBoleto + 2000) . " - " . ($noBoleto + 3333) . " - " . ($noBoleto + 5333) . " - " . ($noBoleto + 8000);
    } else if ($noBoleto >= 1335) {
      $boletos = generarNumeroReal(str_split(strval($noBoleto))) . " - " . ($noBoleto + 2000) . " - " . ($noBoleto + 4000) . " - " . ($noBoleto + 6000) . " - " . ($noBoleto != 2000 ? ($noBoleto + 8000) : "0000");
    }
    return $boletos;
  }
  
?>

<body class="stretched sticky-footer">

  <div id="wrapper" class="clearfix">

  <?php
    include "./components/menu.php";
  ?>


    <!-- Content
		============================================= -->
    <section id="content" class="bg-white">
      <div class="content-wrap py-0">
        <div class="section section-contact my-0" style="background: #ECEEED; padding: 100px 0;">
          <div class="container">
            <div class="row gutter-50">
              <!-- <div class="col-xl-4 col-md-4">
								<h2 class="h2 mb-4 font-weight-semibold">Contact Us</h2>
								<p class="text-black-50">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia aperiam, labore cum ullam, optio ducimus provident corrupti placeat veritatis.</p>
								<a href="mailto:no.reply@semicolonweb.com" class="button button-rounded ml-0">Email Us</a>
							</div> -->

              <div class="col-xl-2 col-md-2"></div>

              <div class="col-xl-4 col-md-4">
                <div class="form-widget">

                  <div class="form-result"></div>

                  <form class="mb-0" method="post" id="comprarBoletoForma">

            

                    <div class="row">
                      <div class="col-12">
                        <h3>Boleto número:&nbsp;&nbsp;<span id="spanNoBoleto"><?php print_r(generarNumeroReal(str_split(strval($noBoleto)))); ?></span></h3>
                        <h4>Sus oportunidades serán: <br> <span><?php include_once "numeracion.php"; $numeros = new calcula; $numeros -> oportunidades ($noBoleto); ?></span></h4>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 form-group">
                        <label for="cajaNombre">Nombre <small>*</small></label>
                        <input type="text" id="cajaNombre" name="cajaNombre" class="form-control" required/>
                      </div>

                      <div class="col-12 form-group">
                        <label for="cajaApellidos">Apellidos <small>*</small></label>
                        <input type="text" id="cajaApellidos" name="cajaApellidos" class="form-control" required/>
                      </div>

                      <div class="col-12 form-group">
                        <label for="cajaTelefono">Telefono (10 dígitos)<small>*</small></label>
                        <input type="text" id="cajaTelefono" name="cajaTelefono" class="form-control" required maxlength="10"/>
                      </div>

                      <div class="col-12 form-group">
                        <label for="cajaCorreo">Correo electrónico (Opcional)</label>
                        <input type="email" name="cajaCorreo" id="cajaCorreo" class="form-control">
                      </div>

                      <div class="col-12 form-group">
                        <label for="">Estado <small>*</small></label>
                        <select class="required select form-control" required id="cajaEstado" name="cajaEstado">
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

                      <div class="col-12 form-group">
                        <label for="cajaMetodoPago">Método de pago: <small>*</small></label>
                        <select name="cajaMetodoPago" id="cajaMetodoPago" class="form-control">
                          <option value="">Seleccione un método de pago</option>
                          <option value="Apartado">Efectivo / Transferencia</option>
                          <option value="Linea">En línea</option>
                        </select>
                      </div>
                      <input type="text" hidden value="<?php echo $noBoleto ?>" id="noBoleto" name="noBoleto">
                      <!-- <div class="col-12 form-group">
                        <button class="button button-rounded button-small float-right m-0" type="submit">Comprar</button>
                      </div> -->
                    </div>
                    <div class="row">
                      <div class="col text-center">
                        <button id="boton-comprar" class="button button-rounded" type="button" onclick="verificarBoleto()">Comprar</button>
                      </div> 
                    </div>

                    <div class="row">
                      <div class="col">
                        <?php

                          $controllerCompras = new ComprasController();
                          $controllerCompras -> ctrAgregarCompra();
                        ?>
                      </div>
                    </div>
                    <div class="row">
                      <div class="row-pago">

                      </div>
                    </div>

                  </form>
                </div>
              </div>

              <div class="col-xl-3 col-md-4">
                <h2 class="h2 mb-4 font-weight-semibold">Tienes dudas?</h2>

                <div class="feature-box fbox-plain bottommargin-sm fbox-sm">
                  <div class="fbox-icon mt-1">
                    <i class="icon-line-phone-call"></i>
                  </div>
                  <div class="fbox-content">
                    <h3 class="font-weight-normal nott mb-2">Llámanos:</h3>
                    <a href="tel:6251500653">625 150 0653 </a><br>
                    <a href="tel:6591057115">659 105 7115 </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
        </div>

      </div>
    </section><!-- #content end -->

    <?php
      include "./components/footer.php";
    ?>

  </div><!-- #wrapper end -->

  <?php
    include "./components/foot.php";
  ?>

  <script>
    // Owl Carousel Scripts
    jQuery(window).on('pluginCarouselReady', function() {
      $('#oc-teachers').owlCarousel({
        items: 1,
        margin: 30,
        nav: true,
        navText: ['<i class="icon-line-arrow-left"></i>', '<i class="icon-line-arrow-right"></i>'],
        dots: false,
        smartSpeed: 300,
        stagePadding: 60,
        responsive: {
          768: {
            stagePadding: 100,
            margin: 30,
            items: 1
          },
          991: {
            stagePadding: 100,
            margin: 40,
            smartSpeed: 400,
            items: 2
          },
          1200: {
            stagePadding: 100,
            margin: 40,
            smartSpeed: 400,
            items: 2
          }
        },
      });
    });

    //Current Week
    Date.prototype.getWeek = function(start) {
      //Calcing the starting point
      start = start || 0;
      var today = new Date(this.setHours(0, 0, 0, 0));
      var day = today.getDay() - start;
      var date = today.getDate() - day;

      // Grabbing Start/End Dates
      var StartDate = new Date(today.setDate(date));
      var EndDate = new Date(today.setDate(date + 6));
      return [StartDate, EndDate];
    }
    var Dates = new Date().getWeek();
    $("#week-details").text(Dates[0].toLocaleDateString() + ' - ' + Dates[1].toLocaleDateString());

    // mostrarModal();
    // document.getElementById('content').onclick = () => {
    //   mostrarModal();
    // }

    /* const html = `
    <div class="row">
      <div class="col text-center">
        <img src="http://localhost/rifas/images/logoSmall.png" class="img-modal">
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        <h3>Su boleto para INSERTE NOMBRE SORTEO ha sido reservado</h3>
        <p>Favor de guardar la siguiente información tomando una captura de pantalla</p>
        <p>Número de boleto: <span style="color: #7E9680"><b>0001</b></span></p>
        <p>Oportunidades:</p>
        <span style="color: #7E9680"><b>0001</b></span>,
        <span style="color: #7E9680"><b>0001</b></span>,
        <span style="color: #7E9680"><b>0001</b></span>,
        <span style="color: #7E9680"><b>0001</b></span>,
        <span style="color: #7E9680"><b>0001</b></span>
      </div>
    </div>
    `; */

    /* function mostrarModal() {
      Swal.fire({
        html: html,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#7E9680'
      }).then((value) => {
        window.location.href = 'index.php';
      });
    } */
    function verificarBoleto(){
      let forma = document.getElementById("comprarBoletoForma");
      let noBoleto = "<?php echo $noBoleto; ?>";
      $.ajax({
            url: './controllers/obtenerBoleto.php',
            type: "GET",
            data: `noBoleto=${parseInt(noBoleto)}`,
            success: function(data) {
              console.log("si entre");
              
              if(data === "false"){
                let nombre = document.getElementById('cajaNombre');
                let apellidos = document.getElementById('cajaApellidos');
                let telefono = document.getElementById('cajaTelefono');
                let estado = document.getElementById('cajaEstado');
                let pago = document.getElementById('cajaMetodoPago');
                if(nombre.value && apellidos.value && telefono.value && estado.value && pago.value){
                  forma.submit();
                }else{
                  Swal.fire({
                      title: 'Favor de completar los datos',
                      icon: 'error',
                      confirmButtonText: 'Aceptar',
                      confirmButtonColor: '#F73164'
                  });
                }

              } else {
                Swal.fire({
                      title: 'El boleto ya no está disponible',
                      icon: 'error',
                      confirmButtonText: 'Aceptar',
                      confirmButtonColor: '#F73164'
                }).then(() => {
                  window.location.href = "boletos.php"
                });
              }
            },
            error: function(data) {
                console.log(data);
            },
            complete: function() {

            },
            cache: false,
            contentType: false,
            processData: false
      });
    }
  </script>
</body>

</html>