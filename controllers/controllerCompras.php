<?php

class ComprasController {

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
      $boletos = $this -> generarNumeroReal(str_split(strval($noBoleto))) . " - " . ($noBoleto + 2000) . " - " . ($noBoleto + 4667) . " - " . ($noBoleto + 6667) . " - " . ($noBoleto + 8000); 
    } else if ($noBoleto >= 668 && $noBoleto < 1335) {
      $boletos = $this -> generarNumeroReal(str_split(strval($noBoleto))) . " - " . ($noBoleto + 2000) . " - " . ($noBoleto + 3333) . " - " . ($noBoleto + 5333) . " - " . ($noBoleto + 8000);
    } else if ($noBoleto >= 1335) {
      $boletos = $this -> generarNumeroReal(str_split(strval($noBoleto))) . " - " . ($noBoleto + 2000) . " - " . ($noBoleto + 4000) . " - " . ($noBoleto + 6000) . " - " . ($noBoleto != 2000 ? ($noBoleto + 8000) : "0000");
    }
    return "<span style=\"color: #7E9680\">" . $boletos . "</span>";
  }

  

  public function ctrAgregarCompra() {

    if (isset($_POST["cajaNombre"])) {

      date_default_timezone_set("America/Chihuahua");

      $datosController = array(
        "nombre" => $_POST["cajaNombre"] . " " . $_POST["cajaApellidos"],
        "telefono" => $_POST["cajaTelefono"],
        "email" => $_POST["cajaCorreo"],
        "noBoleto" => $_POST["noBoleto"],
        "estado" => $_POST["cajaEstado"],
        "fecha" => date("Y-m-d"),
        "fechaPago" => date("Y-m-d"),
        "horaApartado" => date('H:i:s')
      );

    //http://localhost/rifas/manejadorpago.php?confirmar=bV4=&collection_id=1236825908&collection_status=approved&payment_id=1236825908&status=approved&external_reference=null&payment_type=credit_card&merchant_order_id=2681335737&preference_id=494895024-10af83c0-cec0-4a20-aaaa-ae3d4038894c&site_id=MLM&processing_mode=aggregator&merchant_account_id=null
      // $resultado = ComprasModel::mdlAgregarCompra($datosController);
      $sorteo = ComprasModel::mdlObtenerSorteoActual();

      if ($_POST["cajaMetodoPago"] !== "Apartado") {
        require  './vendor/autoload.php';
        // Public key TEST-abaf4acb-bce3-419e-8e2c-f2562a1abe5a
        //TEST-2947797794584283-051500-04f0863f42b9aa6e13c6eb049c3fa28e-494895024

        // Credenciales de sandbox de los buenos
        // Public key TEST-9195592e-08f9-4010-82bd-862a5eab481a
        // TEST-8173005339578211-052022-bb6f23a0af3bf96b5945d7f1d483f9b5-422849335
        
        MercadoPago\SDK::setAccessToken('APP_USR-8173005339578211-052022-bff492d7da501e1e186ff89509119119-422849335');
        // APP_USR-8173005339578211-052022-bff492d7da501e1e186ff89509119119-422849335
        $preference = new MercadoPago\Preference();


        $noBoleto = $_POST["noBoleto"];
        $telefono = $_POST["cajaTelefono"];
        $nombre = $_POST["cajaNombre"] . " " . $_POST["cajaApellidos"];
        $email = $_POST["cajaCorreo"];
        $estado = $_POST["cajaEstado"];


        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        $encryiption_iv = "1234567891011121";
        $encryption_key = "caca";

        $noBoletoEncriptado = openssl_encrypt($noBoleto, $ciphering, $encryption_key, $options, $encryiption_iv);
        $telefonoEncriptado = openssl_encrypt($telefono, $ciphering, $encryption_key, $options, $encryiption_iv);
        $nombreEncriptado = openssl_encrypt($nombre, $ciphering, $encryption_key, $options, $encryiption_iv);
        $emailEncriptado = openssl_encrypt($email, $ciphering, $encryption_key, $options, $encryiption_iv);
        $estadoEncriptado = openssl_encrypt($estado, $ciphering, $encryption_key, $options, $encryiption_iv);

        $item = new MercadoPago\Item();
        $item -> title = "Boleto no. " . generarNumeroReal(str_split(strval($_POST["noBoleto"])));
        $item -> quantity = 1;
        $item -> unit_price = $sorteo["costoBoleto"] . ".00";
        $preference -> items = array($item);
        /* $preference -> back_urls = array(
          "success" => "http://localhost:8888/rifas/manejadorpago.php?nb=" . urlencode($noBoletoEncriptado) . "&t=" . urlencode($telefonoEncriptado) . "&e=" . urlencode($emailEncriptado) . "&n=" . urlencode($nombreEncriptado) . "&s=" . urlencode($estadoEncriptado),
          "failure" => "http://localhost:8888/rifas/manejadorpago.php?eliminar=" . urlencode($noBoletoEncriptado),
          "pending" => "http://localhost:8888/rifas/manejadorpago.php?eliminar=" . urlencode($noBoletoEncriptado)
        ); */
        $preference -> back_urls = array(
          "success" => "https://rifaslosprimos.com/manejadorpago.php?nb=" . urlencode($noBoletoEncriptado) . "&t=" . urlencode($telefonoEncriptado) . "&e=" . urlencode($emailEncriptado) . "&n=" . urlencode($nombreEncriptado) . "&s=" . urlencode($estadoEncriptado),
          "failure" => "https://rifaslosprimos.com/manejadorpago.php?eliminar=" . urlencode($noBoletoEncriptado),
          "pending" => "https://rifaslosprimos.com/manejadorpago.php?eliminar=" . urlencode($noBoletoEncriptado)
        );
        $preference -> save();
        $resultado = "success";

        echo $resultado;

        if ($resultado === "success") {
          // TEST-9195592e-08f9-4010-82bd-862a5eab481a
          // APP_USR-bbf60131-420c-46d4-97c4-623272f0810b
          echo "
            <script>
            const mp = new MercadoPago('APP_USR-bbf60131-420c-46d4-97c4-623272f0810b', {
              locale: 'es-MX'
            });
  
            mp.checkout({
              preference: {
                id: '" . $preference -> id . "'
              },
              autoOpen: true
            });
            
            </script>
            ";
        } else {
          echo "
            <script>
              Swal.fire({
                title: 'No se ha podido registrar su boleto. Inténtelo de nuevo más tarde',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#7E9680'
              }).then((value) => {
                window.location.href = 'index.php';
              });
            </script>
            ";
        }
      } else {
        $resultado = ComprasModel::mdlAgregarCompra($datosController);
        $noBoleto = $datosController["noBoleto"];
        $sorteo = ComprasModel::mdlObtenerSorteoActual();
        if ($resultado === "success") {
          echo "<script>
          const html = `
            <div class=\"row\">
              <div class=\"col text-center\">
                <img src=\"http://rifaslosprimos.com/images/logoSmall.png\" class=\"img-modal\">
              </div>
            </div>
            <div class=\"row mt-4\">
              <div class=\"col\">
                <h3>Boleto Apartado!</h3>
                <p>Favor de guardar la siguiente información tomando una captura de pantalla</p>
                <h2>" . $sorteo["titulo"] . "</h2>
                <br>
                <hr style=\"width: 75% background-color: #7E9680\">
                <h3><span style=\"color: #7E9680\"><b>" . $datosController["nombre"] . "</b></span></h3>
                <p>Oportunidades:<br><span style=\"color: #7E9680\"><b>
                "; 
                include_once "numeracion.php";
                $numeros = new calcula; 
                $numeros -> oportunidades ($noBoleto);
                
                echo  "</b></span><br>
                Costo del boleto: <b>$<span>" . $sorteo["costoBoleto"] . "</span></b><br>
                <hr style=\"width: 75% background-color: #7E9680\"><br>
                <b>Datos para pago y envío de comprobante</b><br><br>
                <b>Zayra Yvonne García Loya</b><br>
                <img style=\"height: 14px\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/BBVA_2019.svg/1920px-BBVA_2019.svg.pn\g\">&nbsp; 4152 3137 0599 6150<br>
                <img style=\"height: 20px\" src=\"https://style.shockvisual.net/wp-content/uploads/2019/05/logo-scotiabank.png\">&nbsp; 4043 1300 0607 6448<br><br>
                <b>Efrén Olivas Miranda - 625 150 0653</b><br>
                <img style=\"height: 14px\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/BBVA_2019.svg/1920px-BBVA_2019.svg.pn\g\">&nbsp; 4152 3138 0752 3639</br></br>
                <b>Karla Fernanda Rodríguez Burciaga</b></br>
                <img style=\"height: 14px\" src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/BBVA_2019.svg/1920px-BBVA_2019.svg.pn\g\">&nbsp; 4152 3138 2897 2716</p>
              </div> 
            </div>`;


            Swal.fire({
              html: html,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#7E9680'
            }).then((value) => {
              window.location.href = 'index.php';
            });
          </script>";
        } else {
          echo "
            <script>
              Swal.fire({
                title: 'No se pudo confirmar su compra, intente de nuevo más tarde',
                icon: 'error',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#7E9680'
              }).then((value) => {
                //window.location.href = 'index.php';
              });
            </script>
          ";
        }
      }
    }
  }

  public function ctrEliminarCompra() {
    if (isset($_GET["eliminar"])) {
      // $noBoletoEncriptado = $_GET["eliminar"];
      // $ciphering = "AES-128-CTR";

      // $decryption_iv = "1234567891011121";
      // $decryption_key = "caca";
      // $options = 0;

      // $noBoleto = openssl_decrypt($noBoletoEncriptado, $ciphering, $decryption_key, $options, $decryption_iv);

      // $resultado = ComprasModel::mdlBorrarCompra($noBoleto);

      echo "<script>
        Swal.fire({
          title: 'Su compra falló, no se guardará su información ',
          icon: 'warning',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#7E9680'
        }).then((value) => {
          window.location.href = 'index.php';
        });
      </script>";
    }
  }

  public function ctrConfirmarCompra() {
    if (isset($_GET["nb"]) && isset($_GET["t"]) && isset($_GET["e"]) && isset($_GET["n"]) && isset($_GET["s"])) {
      $ciphering = "AES-128-CTR";

      $decryption_iv = "1234567891011121";
      $decryption_key = "caca";
      $options = 0;
      $sorteo = ComprasModel::mdlObtenerSorteoActual();

      $nombre =  openssl_decrypt($_GET["n"], $ciphering, $decryption_key, $options, $decryption_iv);
      $telefono =  openssl_decrypt($_GET["t"], $ciphering, $decryption_key, $options, $decryption_iv);
      $email = openssl_decrypt($_GET["e"], $ciphering, $decryption_key, $options, $decryption_iv);
      $noBoleto = openssl_decrypt($_GET["nb"], $ciphering, $decryption_key, $options, $decryption_iv);
      $estado = openssl_decrypt($_GET["s"], $ciphering, $decryption_key, $options, $decryption_iv);

      date_default_timezone_set("America/Chihuahua");

      $hora = date("h:i:s");

      $datosController = array(
        "idSorteo" => $sorteo["idSorteo"],
        "nombre" => $nombre,
        "telefono" => $telefono,
        "email" => $email,
        "noBoleto" => $noBoleto,
        "estado" => $estado,
        "fecha" => date("Y-m-d"),
        "fechaPago" => date("Y-m-d"),
        "horaApartado" => $hora,
        "horaPagado" => $hora
      );


      $resultado = ComprasModel::mdlConfirmarCompra($datosController);

      if ($resultado === "success") {
        echo "<script>
          const html = `
            <div class=\"row\">
              <div class=\"col text-center\">
                <img src=\"http://rifaslosprimos.com/images/logoSmall.png\" class=\"img-modal\">
              </div>
            </div>
            <div class=\"row mt-4\">
              <div class=\"col\">
                <h3>Su boleto ha sido confirmado</h3>
                <h4>Sorteo: " . $sorteo["titulo"] . "</h4>
                <p>Favor de guardar la siguiente información tomando una captura de pantalla</p>
                <p>Nombre: <span style=\"color: #7E9680\"><b>" . $nombre . "</b></span></p>
                <p>Número de boleto: <span style=\"color: #7E9680\"><b>" . $this -> generarNumeroReal(str_split(strval($noBoleto))) . "</b></span></p>
                <p>Oportunidades:</p>
                " . include_once "numeracion.php"; $numeros = new calcula; $numeros -> oportunidades ($noBoleto)  . "
                <p>Costo del boleto: <b>$<span>" . $sorteo["costoBoleto"] . "</span></b></p>
              </div>
            </div>`;


            Swal.fire({
              html: html,
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#7E9680'
            }).then((value) => {
              window.location.href = 'index.php';
            });
        </script>";
      } else {
        echo "
          <script>
            Swal.fire({
              title: 'No se pudo confirmar su compra, contáctese con nosotros',
              icon: 'error',
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#7E9680'
            }).then((value) => {
              window.location.href = 'index.php';
            });
          </script>
        ";
      }
    }
  }
}
