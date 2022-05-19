<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<?php

require_once "./controllers/controllerBoletos.php";
require_once "./models/modelBoletos.php";

include "./components/head.php";
?>

<body class="stretched sticky-footer">

  <div id="wrapper" class="clearfix">

    <?php
    include "./components/menu.php";
    ?>

    <section id="content" class="bg-white">
      <div class="content-wrap py-0">
        <div class="section section-contact my-0" style="background: #ECEEED; padding: 50px 0;">
          <div class="container">
            <div class="row">
              <div class="col">
                <h3 class="font-weight-bold nott" style="font-size: 32px;"> Verificador de boletos</h3>
              </div>
            </div>
            <div class="row align-items-end">
                <div class="col-8">
                    <label for="cajaBoleto">Boleto a verificar</label>
                    <input type="text" id="cajaBoleto" name="cajaBoleto" placeholder="Escribe el número de boleto" class="form-control"/>
                </div>
                <div class="col-4">
                    <button id="boton-comprar" class="button button-rounded" onclick="verificarBoleto()">Verificar</button>
                </div>
            </div>
            <p></p>
            <div id = "resultado">
            
                
            </div>
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
    let boleto = document.getElementById("cajaBoleto");
    let tabla = document.getElementById("resultado"); 
    
    function verificarBoleto() {
      let noBoleto = parseInt(boleto.value);
      let boletoIngresado = parseInt(boleto.value)

      if (Number.isNaN(parseInt(boleto.value))) {
          tabla.innerHTML = `<h3 class = "mt-2"> &nbsp &nbsp Numero inválido</h3>`

      }else if(noBoleto > 9999){
        tabla.innerHTML = `<h3 class = "mt-2"> &nbsp &nbsp Numero inválido</h3>`
      } else {

          if(boletoIngresado > 2500 && boletoIngresado <= 3334){
            noBoleto = 3335 - boletoIngresado;
          }else if(boletoIngresado >= 5835 && boletoIngresado <= 6668){
            noBoleto = boletoIngresado-5834;
          }else if(boletoIngresado >= 8335 && boletoIngresado <= 9168){
            noBoleto = 9169 - boletoIngresado;
          }
          
          
          else if(boletoIngresado >= 3335 && boletoIngresado <= 4168){
            noBoleto = 4168 - boletoIngresado + 835;
          }else if(boletoIngresado >= 5001 && boletoIngresado <= 5834){
            noBoleto = boletoIngresado - 4166;
          }else if(boletoIngresado >= 7501 && boletoIngresado <= 8334){
            noBoleto = 8334 - boletoIngresado + 835;
          }
          
          
          else if(boletoIngresado >= 4169 && boletoIngresado <= 5000){
            noBoleto = 5000 - boletoIngresado + 1669;
          }else if(boletoIngresado >= 6669 && boletoIngresado <= 7500){
            noBoleto = boletoIngresado - 5000;
          }else if(boletoIngresado >= 9169 && boletoIngresado <= 9999){
            noBoleto = 9999 - boletoIngresado + 1670;
          }

        if (boletoIngresado === 0){
            noBoleto = 1669;
        }

        $.ajax({
            url: './controllers/obtenerBoleto.php',
            type: "GET",
            data: `noBoleto=${noBoleto}`,
            success: function(data) {
                var fechaPagado="";

                if (data == 'false'){
                  tabla.innerHTML = `<h3 class = "mt-2"> &nbsp &nbsp El boleto no está vendido</h3>`;
                }
                else{
                  
                  const datos = JSON.parse(data);
                  const fotos = JSON.parse(datos.fotos);
                  let segunda = 0;
                  let tercera = 0;
                  let cuarta = 0;
                  const noBoleto = Number.parseInt(datos.noBoleto);
                  if (noBoleto <= 834) {
                    segunda = 3335 - noBoleto;
                    tercera = noBoleto + 5834;
                    cuarta = 9169 - noBoleto;
                  } else if (noBoleto >= 835 && noBoleto <= 1668) {
                    segunda = 4168 - (noBoleto - 835);
                    tercera = noBoleto + 4166;
                    cuarta = segunda + 4166;
                  } else if (noBoleto >= 1669 && noBoleto <= 2500) {
                    segunda = 5000 - (noBoleto - 1669);
                    tercera = noBoleto + 5000;
                    cuarta = segunda + 5000;
                  }

                  const boletos = `${noBoleto <= 1000 ? '0' : ''}${noBoleto} - ${segunda} - ${tercera} - ${cuarta}`;

                  if(!datos.fechaPago) fechaPagado = "";
                  else fechaPagado = datos.fechaPago;

                  tabla.innerHTML = `
                                    <div class="card bg-light text-center col-lg-12">
                                      <div class="">
                                      <a href="#"><img style="height: 130px; width:130px;" src="images/logoRifas.png" alt="Logo"></a>
                                      </div>
                                      <img class="card-img-top" style="margin:auto; height: 20%; width: 40%;" src="backend/views/${fotos[0]}" alt="Card image cap">
                                      <div class="card-body">
                                        <h2 class="card-title">${datos.nombre}</h2>
                                        <h3 class="card-title">${boletos}</h3>
                                        <h3 class="card-title">${(datos.status === "P" || datos.status === "L") ? ('Pagado') : ('No pagado')}</h3>
                                        <h4 class="card-text">Fecha Apartado: ${datos.fecha}</h4>
                                        <h4 class="card-text">${(datos.status === "P" || datos.status === "L") ? ('Fecha Pagado: '+ fechaPagado) : ('')}</h4>
                                      </div>
                                    </div>`;
                
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