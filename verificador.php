<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<?php

require_once "./models/conexion.php";
require_once "./controllers/controllerBoletos.php";
require_once "./models/modelBoletos.php";

require_once "./controllers/controllerSorteos.php";
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

      }else if(noBoleto > 59999){
        tabla.innerHTML = `<h3 class = "mt-2"> &nbsp &nbsp Numero inválido</h3>`
      } else {

          if(boletoIngresado > 15001 && boletoIngresado <= 20000){
            noBoleto = 20001 - boletoIngresado;
          }else if(boletoIngresado >= 35001 && boletoIngresado <= 40000){
            noBoleto = boletoIngresado-35000;
          }else if(boletoIngresado >= 50001 && boletoIngresado <= 55000){
            noBoleto = 55001 - boletoIngresado;
          }
          
          
          else if(boletoIngresado >= 20001 && boletoIngresado <= 25000){
            noBoleto = 25000 - boletoIngresado + 5001;
          }else if(boletoIngresado >= 30001 && boletoIngresado <= 35000){
            noBoleto = boletoIngresado - 24998;
          }else if(boletoIngresado >= 45001 && boletoIngresado <= 50000){
            noBoleto = 50000 - boletoIngresado + 5001;
          }
          
          
          else if(boletoIngresado >= 25001 && boletoIngresado <= 30000){
            noBoleto = 5000 - boletoIngresado + 10001;
          }else if(boletoIngresado >= 40001 && boletoIngresado <= 45000){
            noBoleto = boletoIngresado - 30000;
          }else if(boletoIngresado >= 55001 && boletoIngresado <= 59999){
            noBoleto = 59999 - boletoIngresado + 10002;
          }

        if (boletoIngresado === 0){
            noBoleto = 10001;
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
                  let noBoleto = Number.parseInt(datos.noBoleto);
                  if (noBoleto <= 5000) {
                    segunda = 20001 - noBoleto;
                    tercera = noBoleto + 35000;
                    cuarta = 55001 - noBoleto;
                  } else if (noBoleto >= 5001 && noBoleto <= 10000) {
                    segunda = 25000 - (noBoleto - 5001);
                    tercera = noBoleto + 25000;
                    cuarta = segunda + 25000;
                  } else if (noBoleto >= 10001 && noBoleto <= 15000) {
                    segunda = 30000 - (noBoleto - 10001);
                    tercera = noBoleto + 30000;
                    cuarta = segunda + 30000;
                    // if (cuarta == 60000) cuarta = '00000';
                  }

                  if (noBoleto <= 9) noBoleto = '0000'+ noBoleto;
                  else if (noBoleto <= 99) noBoleto = '000' + noBoleto;
                  else if (noBoleto <= 999) noBoleto = '00' + noBoleto;
                  else if (noBoleto <= 9999) noBoleto = '0' + noBoleto;

                  const boletos = `${noBoleto} - ${segunda} - ${tercera} - ${cuarta}`;

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
                                        <h4 class="card-text">Fecha Apartado: ${datos.fecha} a las ${datos.horaApartado}</h4>
                                        <h4 class="card-text">${(datos.status === "P" || datos.status === "L") ? ('Fecha Pagado: '+ fechaPagado + ' a las ' + datos.horaPagado) : ('')}</h4>
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