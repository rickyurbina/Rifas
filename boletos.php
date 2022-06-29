<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<?php

 require_once "./models/conexion.php";
 require_once "./controllers/controllerBoletos.php";
 require_once "./controllers/controllerSorteos.php";

 require_once "./models/modelBoletos.php";
 require_once "./models/modelSorteos.php";

include "./components/head.php";
?>

<body class="stretched sticky-footer">

  <div id="wrapper" class="clearfix">

    <?php
    include "./components/menu.php";
    ?>

    <section id="content" class="bg-white">
      <div class="content-wrap py-0">
        <div class="section section-contact my-0" style="background: #ECEEED; padding: 100px 0;">
          <div class="container">
            <div class="row m-5">
              <div class="col">
                <h3 class="font-weight-bold nott" style="font-size: 42px;"> Boletos Disponibles</h3>
              </div>
            </div>
            <div class="row align-items-end ">
              <div class="col-8">
                  <label for="cajaBoleto">Busca tu boleto</label>
                  <input type="text" id="cajaBoleto" name="cajaBoleto" placeholder="Numero de boleto (4 dígitos)" class="form-control">
              </div>
              <div class="col-4">
                <button id="boton-buscar" class="button button-rounded" onclick="buscarBoleto()">Buscar</button>
              </div>
            </div>
            <br><br>
            <?php
            $controllerSorteos = new BoletosController();
            $controllerSorteos -> ctrListarBoletosOcupados();
            
            ?>
          </div>
        </div>
      </div>
    </section>

    <div id="gotoTop" class="icon-angle-up"></div>

    <?php
    include "./components/footer.php";
    ?>
  </div>
  <?php
  include "./components/foot.php";
  ?>
  <script>
    function comprarBoleto(noBoleto) {
      window.location.href = `compra.php?noBoleto=${noBoleto}`;
    }

    function buscarBoleto(){
      let boleto = document.getElementById("cajaBoleto");

      if (!Number(boleto.value)) {
        Swal.fire({
            title: 'El numero ingresado no es válido',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#F73164'
        });

      } else {
        $.ajax({
            url: './controllers/obtenerBoleto.php',
            type: "GET",
            data: `noBoleto=${parseInt(boleto.value)}`,
            success: function(data) {
                const datos = JSON.parse(data);
                if(data == "false"){
                  window.location.href = `compra.php?noBoleto=${boleto.value}`;
                }else{
                  Swal.fire({
                      title: 'El boleto ya no esta disponible',
                      icon: 'error',
                      confirmButtonText: 'Aceptar',
                      confirmButtonColor: '#F73164'
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
    }
  </script>

</body>

</html>