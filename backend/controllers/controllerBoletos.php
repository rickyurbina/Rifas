<?php
    class BoletosController {

        function ctlBuscarBoleto($noBoleto){
          $resultado = BoletosModel::mdlBuscarNoBoleto($noBoleto);
      
          return $resultado;
        }

        public function ctrMostrarDashboard(){
          $vendidos = BoletosModel::mdlObtenerBoletosVendidos();
          $sorteoActual = BoletosModel::mdlObtenerSorteoActual();
          $ingresos = $vendidos[0] * $sorteoActual["costoBoleto"];
          $porcentaje = ($vendidos[0])*(100/$sorteoActual["noBoletos"]); 
          echo'
          <div class="row">
            <div class="col-xl-3 box-col-3 col-lg-12 col-md-3">
              <div class="card o-hidden">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body">
                      <p class="f-w-500 font-roboto">Ingresos por boletos vendidos <span class="badge pill-badge-primary ml-3">$</span></p>
                      <div class="progress-box">
                        <h4 class="f-w-500 mb-0 f-26">$<span class="counter">'.$ingresos.'</span></h4>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 box-col-4 col-lg-12 col-md-4">
              <div class="card o-hidden">
                <div class="card-body">
                  <div class="media">
                    <div class="media-body">
                      <p class="f-w-500 font-roboto">Boletos vendidos <span class="badge pill-badge-primary ml-3">%</span></p>
                      <div class="progress-box">
                        <h4 class="f-w-500 mb-0 f-26"><span class="counter">'.$vendidos[0].'</span></h4>
                        <div class="progress sm-progress-bar progress-animate app-right d-flex justify-content-end">
                          <div class="progress-gradient-primary" role="progressbar" style="width: 35%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="font-primary">'.$porcentaje.'%</span><span class="animate-circle"></span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          ';
        }

        function ctrbuscarBoletosDisponibles($idSorteo){
            $respuesta = BoletosModel::mdlBuscaBoletos("boletos",$idSorteo);
            $text = "";
            $num = 0; $count=count($respuesta);
            print_r($count);
            for ($i = 1; $i <= 2500; $i++) {
                if ($i != $respuesta[$num]["noBoleto"]) {
                    
                    $ceros="";
                    if ($i < 10) {
                        $ceros = "000";
                    } else if($i>=10 && $i <100){
                        $ceros = "00";
                    } else if($i > 100 && $i < 1000) {
                        $ceros = "0";
                    }
                    echo'<option value='.$i.'>'.$ceros.''.$i.'</option>';
                } else {
                    print_r('entre en '.$i.' conteo: '.$num.'');
                    if ($num != $count) {
                        $num=$num+1;
                    }
                }
            }
        }

        public function ctrAgregaBoleto(){
            $idSorteo = BoletosModel::mdlObtenerSorteoActual();
            if(isset($_POST["cajaNombreCliente"])){
                date_default_timezone_set("America/Chihuahua");

                if ($_POST["cajaStatusVenta"] == 'P'){
                  $fechaPago = date("Y-m-d");
                  $horaPagado = date("h:i:s");
                }
                else{
                  $fechaPago = '1000-01-01';
                  $horaPagado = '00:00:00';

                }
                $datosController = array(
                    "nombre" => $_POST["cajaNombreCliente"],
                    "telefono" => $_POST["cajaTelefonoCliente"],
                    "email" => $_POST["cajaEmailUsuario"],
                    "noBoleto" => $_POST["cajaNoBoleto"],
                    "status" => $_POST["cajaStatusVenta"],
                    "estado" => $_POST["cajaEstadoUsuario"],
                    "idSorteo" => $idSorteo[0],
                    "fecha" => date("Y-m-d"),
                    "fechaPago"=> $fechaPago,
                    "horaApartado" => date("h:i:s"),
                    "horaPagado" => $horaPagado
                );
                $respuesta = BoletosModel::mdlAgregarBoleto($datosController);

                if ($respuesta === "success") {
                    echo "
                    <script>
                      Swal.fire({
                        title: 'Boleto agregado exitosamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F73164'
                      }).then((value) => {
                        window.location.href = 'inicio.php?action=lstSorteos';
                      });
                    </script>
                    ";
                } else {
                  print_r($respuesta);
                    // echo "
                    // <script>
                    //   Swal.fire({
                    //     title: 'Error al agregar el boleto',
                    //     icon: 'error',
                    //     confirmButtonText: 'Aceptar',
                    //     confirmButtonColor: '#F73164'
                    //   });
                    // </script>
                    // ";
                }
            }
        }

        public function ctrMostrarAgregarBoleto(){
          $idSorteo = BoletosModel::mdlObtenerSorteoActual();
          $boletos = BoletosModel::mdlBuscaBoletos("boletos",$idSorteo["idSorteo"]);
          echo'
          
            <div class="row">
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaNombreCliente">Nombre del cliente: *</label>
                  <input type="text" required name="cajaNombreCliente" id="cajaNombreCliente" class="form-control" >
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
                        <select class="form-control digits" required onchange="calculaBoletos(event)" id="cajaNoBoleto" name="cajaNoBoleto" >
                          <option value="">Seleccione No de boleto</option>    
                        ';
                            $this -> ctrbuscarBoletosDisponibles($idSorteo["idSorteo"]);
                            
                            echo'
                        </select>
                        <span id="spanBoletos"></span>
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
                <button class="btn btn-secondary btn-block" type="button" onclick="verificaBoletos()">Guardar</button>
              </div>
            </div>
            
          ';
        }

        public function ctrBuscarBoleto($noBoleto, $idSorteo) {
          $resultado = BoletosModel::mdlBuscarBoletoPorSorteo($noBoleto, $idSorteo);
          return $resultado;
        }

        public function ctrActualizarBoleto() {
          if (isset($_POST["cajaNoBoleto2"])) {
            $datosController = array(
              "idSorteo" => BoletosModel::mdlObtenerSorteoActual()["idSorteo"],
              "noBoleto" => $_POST["cajaNoBoleto2"],
              "nombre" => $_POST["cajaNombreCliente"],
              "telefono" => $_POST["cajaTelefonoCliente"],
              "estado" => $_POST["cajaEstadoUsuario"],
              "email" => $_POST["cajaEmailUsuario"],
              "status" => $_POST["cajaStatusVenta"],
              "fechaApartado" => $_POST["cajafechaApartado"],
              "fechaPagado" => $_POST["cajafechaPagado"],
              "horaApartado" => $_POST["cajahoraApartado"],
              "horaPagado" => $_POST["cajahoraPagado"]
            );
            $respuesta = BoletosModel::mdlActualizarBoleto($datosController);

            if ($respuesta === "success") {
              echo "
              <script>
                Swal.fire({
                  title: 'Boleto actualizado exitosamente',
                  icon: 'success',
                  confirmButtonText: 'Aceptar',
                  confirmButtonColor: '#F73164'
                }).then((value) => {
                  window.location.href = 'inicio.php?action=lstSorteos';
                });
              </script>
              ";
            } else {
              var_dump($respuesta);
              echo "
                <script>
                  Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#F73164'
                  });
                </script>
              ";
            }
          }
        }

        public function ctrListarTodosLosNumeros($idSorteo){
          $respuesta = BoletosModel::mdlBuscaBoletos("boletos",$idSorteo);
          $j = 0;
          $boletos = "";
          for ($i = 0; $i < 2500; $i++) {
            include_once "../../numeracion.php"; 
              $numeros = new calcula; 
              $boletos = $numeros -> oportunidadesRetorno($i + 1);          

            if (isset($respuesta[$j])) {
              
              if ($respuesta[$j]["noBoleto"] == ($i + 1)) {
                $tipoVenta = $respuesta[$j]["status"] == "P" ? ("Efectivo") : ($respuesta[$j]["status"] == "L" ? ("En Línea") : ("No pagado"));
                $fecha = "";
                $fechaPago="";
              if(DateTime::createFromFormat('Y-m-d', $respuesta[$j]["fecha"])){
                $dateTime =  DateTime::createFromFormat('Y-m-d', $respuesta[$j]["fecha"]);
                $fecha = $dateTime->format('d-m-Y');
              }

              if( $respuesta[$j]["fechaPago"] != '0000-00-00') {
                $dateTime =  DateTime::createFromFormat('Y-m-d', $respuesta[$j]["fechaPago"]);
                $fechaPago = $dateTime->format('d-m-Y');
              }

                echo 
                '
                  <tr>
                    <td style="padding-top: 10px">'.$boletos.'</td>
                    <td style="padding-top: 10px">'.$respuesta[$j]["nombre"].'</td>
                    <td style="padding-top: 10px">'.$respuesta[$j]["telefono"].'</td>
                    <td style="padding-top: 10px">'.$respuesta[$j]["email"].'</td>
                    <td style="padding-top: 10px">'.$fecha.'</td>
                    <td style="padding-top: 10px">'.$fechaPago.'</td>
                    <td style="padding-top: 10px">'.$respuesta[$j]['horaApartado'].'</td>
                    <td style="padding-top: 10px">'.$respuesta[$j]['horaPagado'].'</td>
                    
                    <td style="padding-top: 10px">'.$tipoVenta.'</td>
                  </tr>
                ';
                $j++;
              } else {
                echo '
                <tr>
                  <td style="padding-top: 10px">'.$boletos.'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                </tr>
                ';
              }
            } else {
              echo '
                <tr>
                  <td style="padding-top: 10px">'.$boletos.'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                  <td style="padding-top: 10px">'."No vendido".'</td>
                </tr>
                ';
            }
          }
        }

        public function ctrListarBoletosVendidos($idSorteo){
            $respuesta = BoletosModel::mdlBuscarBoletosVendidos($idSorteo);
            $boletos = "";
            foreach ($respuesta as $row => $item){
                $noBoleto = $item['noBoleto'];
                include_once "../../numeracion.php"; 
                $numeros = new calcula; 
                $boletos = $numeros -> oportunidadesRetorno($noBoleto);
                // if ($item["noBoleto"] >= 1 && $item["noBoleto"] <668){
                //     $boletos = ''.$item["noBoleto"].', '.($item["noBoleto"]+2000).', '.($item["noBoleto"] +4667).', '.($item["noBoleto"]+6667).', '.($item["noBoleto"]+8000).'';
                //   }else if($item["noBoleto"] >= 668 && $item["noBoleto"] <1335){
                //     $boletos = ''.$item["noBoleto"].', '.($item["noBoleto"]+2000).', '.($item["noBoleto"] +3333).', '.($item["noBoleto"]+5333).', '.($item["noBoleto"]+8000).'';
                //   } else if($item["noBoleto"] >=1335 ){
                //     $boletos = ''.$item["noBoleto"].', '.($item["noBoleto"]+2000).', '.($item["noBoleto"] +4000).', '.($item["noBoleto"]+6000).', '.(($item["noBoleto"] != 2000) ? ($item["noBoleto"]+8000) : ("0000")).'';
                //   }
                  $tipoVenta = $item["status"] == "P" ? ("Efectivo") : ("En línea");
                  $fecha = "";
                  $fechaPago="";
                  if(DateTime::createFromFormat('Y-m-d', $item["fecha"])){
                    $dateTime =  DateTime::createFromFormat('Y-m-d', $item["fecha"]);                
                    $fecha = $dateTime->format('d-m-Y');
                  }
                  if(DateTime::createFromFormat('Y-m-d', $item["fechaPago"])){
                    $dateTime =  DateTime::createFromFormat('Y-m-d', $item["fechaPago"]);                
                    $fechaPago = $dateTime->format('d-m-Y');
                  }
                echo '
                  <tr>
                    <td>'.$boletos.'</td>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$fecha.' - '. $item['horaApartado'] .'</td>
                    <td>'.$fechaPago.' - '. $item['horaPagado'] .'</td>
                    <td>'.$tipoVenta.'</td>
                    <td>'.$item["telefono"].'</td>
                  </tr>
                ';
              }
        }
        public function ctrListarBoletosPendientes($idSorteo){
            $respuesta = BoletosModel::mdlBuscarBoletosPendientes($idSorteo);
            $boletos = "";
            foreach ($respuesta as &$item){
                $item["noBoleto"] = intval($item["noBoleto"]);
                $noBoleto = $item['noBoleto'];
                include_once "../../numeracion.php"; 
                $numeros = new calcula; 
                $boletos = $numeros -> oportunidadesRetorno($noBoleto);

                  $fecha = "";
                  if(DateTime::createFromFormat('Y-m-d', $item["fecha"])){
                    $dateTime =  DateTime::createFromFormat('Y-m-d', $item["fecha"]);
               
                    $fecha = $dateTime->format('d-m-Y');
                  }
                echo '
                  <tr>
                    <td>'.$boletos.'</td>
                    <td>'.$item["nombre"].'</td>
                    <td>'.$item["telefono"].'</td>
                    <td>'. $fecha .' - '. $item['horaApartado'] .'</td>
                    <td>
                        <a href="inicio.php?action=lstBoletosPendientes&idSorteo='.$item["idSorteo"].'&idBoletoCompletar='.$item["idBoleto"].'"> <button class="btn btn-primary"> <i class="fas fa-check" style="font-size: 16px"> </i></button></a>
                        <button  onclick="borrarBoleto(' . $item["idBoleto"] . ','.$idSorteo.')" class="btn btn-danger"> <i class="fas fa-trash-alt" style="font-size: 16px"> </i></button>
                    </td>
                  </tr>
                ';
              }
        }

        public function ctrPagarBoleto($idSorteo){
            if(isset($_GET["idBoletoCompletar"])){
                $respuesta = BoletosModel::mdlCompletarBoleto($_GET["idBoletoCompletar"]);
                if ($respuesta === "success") {
                    echo '
                    <script>
                      Swal.fire({
                        title: "Boleto actualizado exitosamente",
                        icon: "success",
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#F73164"
                      }).then((value) => {
                        window.location.href = "inicio.php?action=lstBoletosPendientes&idSorteo='.$idSorteo.'";
                      });
                    </script>
                    ';
                } else {
                    echo "
                    <script>
                      Swal.fire({
                        title: 'Error al actualizar el boleto',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F73164'
                      });
                    </script>
                    ";
                }
            }
        }

        public function ctrBorrarBoleto(){
            if(isset($_GET["idBoletoBorrar"])){
                $respuesta = BoletosModel::mdlBorrarBoleto($_GET["idBoletoBorrar"]);
                if ($respuesta === "success") {
                    echo '
                    <script>
                      Swal.fire({
                        title: "Boleto eliminado exitosamente",
                        icon: "success",
                        confirmButtonText: "Aceptar",
                        confirmButtonColor: "#F73164"
                      }).then((value) => {
                        window.location.href = "inicio.php?action=lstSorteos";
                      });
                    </script>
                    ';
                } else {
                    echo "
                    <script>
                      Swal.fire({
                        title: 'Error al eliminar el boleto',
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
