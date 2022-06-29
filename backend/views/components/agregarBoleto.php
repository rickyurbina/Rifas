
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5>Agregar boleto</h5>
        </div>
        <div class="card-body">
          <form class="theme-form" method="POST" id="nuevoBoletoForm">
            <?php
              $controllerBoletos = new BoletosController();
              $controllerBoletos -> ctrMostrarAgregarBoleto();  
              $controllerBoletos -> ctrAgregaBoleto();
            ?>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    let boletos = document.getElementById("spanBoletos"); 
    let noBoleto = document.getElementById("cajaNoBoleto");
    let formulario = document.getElementById("nuevoBoletoForm");

    function calculaBoletos(e){
      let num = parseInt(e.target.value);
      if (e.target.value === ""){
        boletos.innerHTML = " ";
      }else{
        const noBoleto = num;
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

        const boletoString = `Boletos de regalo: ${noBoleto <= 1000 ? '0' : ''}${noBoleto} - ${segunda} - ${tercera} - ${cuarta}`;
        boletos.innerHTML = boletoString;
        // if (num >= 1 && num <668){
        //   boletos.innerHTML = `Boletos de regalo: ${(num+2000)}, ${(num+4667)}, ${(num+6667)}, ${(num+8000)}`;
        // }else if(num >= 668 && num <1335){
        //   boletos.innerHTML = `Boletos de regalo: ${(num+2000)}, ${(num+3333)}, ${(num+5333)}, ${(num+8000)}`;
        // } else if(num >=1335 ){
        //   boletos.innerHTML = `Boletos de regalo: ${(num+2000)}, ${(num+4000)}, ${(num+6000)}, ${num != 2000 ? (num+8000) : ("0000")}`;
        // }
      }
    }
    function verificaBoletos(){
      if(!noBoleto.value){
        Swal.fire({
              title: 'Favor de completar los datos',
              icon: 'error',
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#F73164'
        });
      }else{
        $.ajax({
            url: '../controllers/obtenerBoleto.php',
            type: "GET",
            data: `noBoleto=${parseInt(noBoleto.value)}`,
            success: function(data) {
                if(data === "false"){
                  let nombre = document.getElementById('cajaNombreCliente'); 
                  let telefono = document.getElementById('cajaTelefonoCliente');
                  let estado = document.getElementById('cajaEstadoUsuario');
                  console.log(nombre.value);
                  if(nombre.value !== "" && telefono.value !== ""  && estado.value !== ""){
                    formulario.submit();  
                  }else{
                    Swal.fire({
                      title: 'Favor de completar los datos',
                      icon: 'error',
                      confirmButtonText: 'Aceptar',
                      confirmButtonColor: '#F73164'
                    });
                  }
                }else{
                  Swal.fire({
                        title: 'El boleto ya no esta disponible',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F73164'
                  }).then(() => {
                    window.location.href = "inicio.php?action=agregarBoleto"
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