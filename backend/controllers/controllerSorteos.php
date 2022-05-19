<?php

class SorteosController {

  public function ctrAgregarSorteo() {
    
    if (isset($_POST["cajaTituloSorteo"])) {
      $noArchivo = 0;
      $archivos = array(
        "0" => "",
        "1" => "",
        "2" => "",
        "3" => "",
        "4" => ""
      );

      foreach ($_FILES as $file) {
        if (isset($file["name"])) {
          $output = "";
          if ($file["name"]) {

            $nameExploded = explode(".", $file["name"]);
            $extension = end($nameExploded);
            $output = "img/sorteos/" . uniqid(strtolower(str_replace(' ', '', $_POST["cajaTituloSorteo"])) . "-") . "." . $extension;
            
            move_uploaded_file($file["tmp_name"], $output);
          }
          
          $archivos[$noArchivo] = $output;
          $noArchivo++;
        }
      }

      $fotos = '{
        "0": "' . $archivos[0] . '",
        "1": "' . $archivos[1] . '",
        "2": "' . $archivos[2] . '",
        "3": "' . $archivos[3] . '",
        "4": "' . $archivos[4] . '"
      }';


      $datosController = array(
        "titulo" => $_POST["cajaTituloSorteo"],
        "subtitulo" => $_POST["cajaSubtituloSorteo"],
        "fecha" => $_POST["cajaFechaSorteo"],
        "noBoletos" => $_POST["cajaNoBoletos"],
        "costoBoleto" => $_POST["cajaPrecioBoleto"],
        "descripcion" => $_POST["cajaDescripcionSorteo"],
        "fotos" => $fotos,
        "segundoLugar" => $_POST["cajaSegundoLugar"],
        "tercerLugar" => $_POST["cajaTercerLugar"],
        "adicionales" => $_POST["cajaAdicionalesSorteo"]
      );

      $respuesta = SorteosModel::mdlAgregarSorteo($datosController);

      if ($respuesta === "success") {
        echo "
        <script>
          Swal.fire({
            title: 'Sorteo agregado exitosamente',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#F73164'
          }).then((value) => {
            window.location.href = 'inicio.php?action=listaSorteos';
          });
        </script>
        ";
      } else {
        echo "
        <script>
          Swal.fire({
            title: 'Error al agregar el sorteo',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#F73164'
          });
        </script>
        ";
      }
    }
  }

  public function ctrBorrarSorteo() {
    if (isset($_GET["idBorrar"])) {
      $idBorrar = $_GET["idBorrar"];

      $sorteo = SorteosModel::mdlBuscarSorteo($idBorrar);
      $fotos = json_decode($sorteo["fotos"], true);

      foreach ($fotos as $foto) {
        if ($foto) {
          unlink($foto);
        }
      }

      $respuesta = SorteosModel::mdlBorrarSorteo($idBorrar);

      if ($respuesta === "success") {
        echo "
          <script>
            Swal.fire({
              title: 'Sorteo eliminado exitosamente',
              icon: 'success',
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#F73164'
            }).then((value) => {
              window.location.href = 'inicio.php?action=lstSorteos';
            });
          </script>
        ";
      } else {
        echo "
          <script>
            Swal.fire({
              title: 'Error al borrar el sorteo',
              icon: 'error',
              confirmButtonText: 'Aceptar',
              confirmButtonColor: '#F73164'
            });
          </script>
        ";
      }
    }
  }

  public function ctrActualizarSorteo($idSorteo) {
    if (isset($_POST["cajaTituloSorteo"])) {
      $datosController = array(
        "idSorteo" => $idSorteo,
        "titulo" => $_POST["cajaTituloSorteo"],
        "subtitulo" => $_POST["cajaSubtituloSorteo"],
        "fecha" => $_POST["cajaFechaSorteo"],
        "noBoletos" => $_POST["cajaNoBoletos"],
        "costoBoleto" => $_POST["cajaPrecioBoleto"],
        "descripcion" => $_POST["cajaDescripcionSorteo"],
        "segundoLugar" => $_POST["cajaSegundoLugar"],
        "tercerLugar" => $_POST["cajaTercerLugar"],
        "adicionales" => $_POST["cajaAdicionalesSorteo"]
      );

      $respuesta = SorteosModel::mdlActualizarSorteo($datosController);

      if ($respuesta === "success") {
        echo "
          <script>
            Swal.fire({
              title: 'Sorteo actualizado exitosamente',
              icon: 'success',
              confirmButtonText: 'Aceptar',
              confirmButtonCOlor: '#F73164'
            }).then((value) => {
              window.location.href = 'inicio.php?action=lstSorteos';
            });
          </script>
        ";
      } else {
        echo "<script>
          Swal.fire({
            title: 'Error al actualizar el sorteo',
            icon: 'error',
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#F73614'
          });
        </script>";
      }
    }
  }

  public function ctrBuscarSorteo($idSorteo) {
    $respuesta = SorteosModel::mdlBuscarSorteo($idSorteo);
    $hoy = getdate();
    $minDate = $hoy["year"] . "-" . (( $hoy["mon"] < 10) ? "0" : "") . $hoy["mon"] . "-" . (($hoy["mday"] < 10) ? "0" : "") . $hoy["mday"];

    echo '
    <div class="container-fluid">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h5>Editar sorteo</h5>
            </div>
            <div class="card-body">
              <form class="theme-form" method="POST" enctype="multipart/form-data">
                <div class="row justify-content-center">
                  <div class="col-2" style="position: relative;">
                    <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen(\'img-0\');"></i>
                    <img id="img-0" class="img-form" onclick="document.getElementById(\'input-img-0\').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                    <input type="file" accept="image/*" name="input-img-0" id="input-img-0" hidden onchange="previsualizarImagen(event, \'img-0\');">
                  </div>
                  <div class="col-2" style="position: relative;">
                    <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen(\'img-1\');"></i>
                    <img id="img-1" class="img-form" onclick="document.getElementById(\'input-img-1\').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                    <input type="file" accept="image/*" name="input-img-1" id="input-img-1" hidden onchange="previsualizarImagen(event, \'img-1\');">
                  </div>
                  <div class="col-2" style="position: relative;">
                    <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen(\'img-2\');"></i>
                    <img id="img-2" class="img-form" onclick="document.getElementById(\'input-img-2\').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                    <input type="file" accept="image/*" name="input-img-2" id="input-img-2" hidden onchange="previsualizarImagen(event, \'img-2\');">
                  </div>
                  <div class="col-2" style="position: relative;">
                    <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen(\'img-3\');"></i>
                    <img id="img-3" class="img-form" onclick="document.getElementById(\'input-img-3\').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                    <input type="file" accept="image/*" name="input-img-3" id="input-img-3" hidden onchange="previsualizarImagen(event, \'img-3\');">
                  </div>
                  <div class="col-2" style="position: relative;">
                    <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen(\'img-4\');"></i>
                    <img id="img-4" class="img-form" onclick="document.getElementById(\'input-img-4\').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                    <input type="file" accept="image/*" name="input-img-4" id="input-img-4" hidden onchange="previsualizarImagen(event, \'img-4\');">
                  </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-12">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaTituloSorteo">Título:</label>
                      <input type="text" name="cajaTituloSorteo" id="cajaTituloSorteo" class="form-control" required value="' . $respuesta["titulo"] . '">
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-12">
                    <div class="form-group">
                      <label for="col-form-label pt-9" for="cajaSubtituloSorteo">Subtítulo:</label>
                      <input type="text" name="cajaSubtituloSorteo" id="cajaSubtituloSorteo" class="form-control" required value="' . $respuesta["subtitulo"] . '">
                    </div>
                  </div>
                  <div class="col-md-4 col-lg-4 col-12">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaFechaSorteo">Fecha:</label>
                      <input type="date" name="cajaFechaSorteo" id="cajaFechaSorteo" min="' . $minDate . '" class="form-control" required value="' . $respuesta["fecha"] . '">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-lg-6 col-12">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaNoBoletos">Número de boletos:</label>
                      <input type="number" name="cajaNoBoletos" id="cajaNoBoletos" class="form-control" required value="' . $respuesta["noBoletos"] . '">
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-12">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaPrecioBoleto">Costo del boleto:</label>
                      <input type="number" name="cajaPrecioBoleto" id="cajaPrecioBoleto" class="form-control" required value="' . $respuesta["costoBoleto"] . '">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-lg-6 col-12">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaSegundoLugar">Premio segundo lugar:</label>
                      <input type="text" name="cajaSegundoLugar" id="cajaSegundoLugar" class="form-control" required value="'.$respuesta["segundoLugar"].'">
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-12">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaTercerLugar">Premio tercer lugar</label>
                      <input type="text" name="cajaTercerLugar" id="cajaTercerLugar" class="form-control" required value="'.$respuesta["tercerLugar"].'">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaDescripcionSorteo">Caracteristicas premio principal:</label>
                      <textarea name="cajaDescripcionSorteo" id="cajaDescripcionSorteo" class="form-control" required>' . $respuesta["descripcion"] . '</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label class="col-form-label pt-0" for="cajaAdicionalesSorteo">Premios adicionales del primer lugar:</label>
                      <textarea name="cajaAdicionalesSorteo" id="cajaAdicionalesSorteo" class="form-control" required>' . $respuesta["adicionales"] . '</textarea>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-8">
                    <button class="btn btn-secondary btn-block">Guardar cambios</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function previsualizarImagen(event, idImg) {

        const fileReader = new FileReader();
        fileReader.onload = () => {
          const img = document.getElementById(idImg);
          img.src = fileReader.result;

        };

        fileReader.readAsDataURL(event.target.files[0]);
      }

      function removeImagen(idImg) {
        document.getElementById(idImg).src = \'http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg\';
        document.getElementById(`input-${idImg}`).value = \'\';
      }
    </script>
    ';

  }


  public function ctrListarSorteos() {
    $respuesta = SorteosModel::mdlListarSorteos(); 
    foreach ($respuesta as $sorteo){
      echo '
        <tr>
          <td>'.$sorteo["titulo"].'</td>
          <td>'.$sorteo["fecha"].'</td>
          <td>'.$sorteo["costoBoleto"].'</td>
          <td>'.$sorteo["faltan"].'</td>
          <td class="text-center">
            <a href="inicio.php?action=lstBoletosVendidos&idSorteo='.$sorteo["idSorteo"].'"><button class="btn btn-success"> <i class="fas fa-check" style="font-size: 16px"> </i></button></a>
            <a href="inicio.php?action=lstBoletosPendientes&idSorteo='.$sorteo["idSorteo"].'"><button class="btn btn-warning"> <i class="fas fa-dollar-sign" style="font-size: 16px"> </i></button></a>
            <a href="inicio.php?action=lstBoletosTotales&idSorteo='.$sorteo["idSorteo"].'"><button class="btn btn-info"><i class="fas fa-ticket-alt" style="font-size: 16px"> </i></button></a>
          </td>
          <td class="text-center">
            <a href="inicio.php?action=uptSorteo&idEditar='.$sorteo["idSorteo"].'"><button class="btn btn-primary" > <i class="fas fa-pencil-alt" style="font-size: 16px"> </i></button></a>
            <button class="btn btn-secondary"><i class="fas fa-lock"></i></button>
            <!--<button onclick="borrarSorteo(' . $sorteo["idSorteo"] . ')" class="btn btn-secondary" > <i class="fas fa-trash-alt" style="font-size: 16px"> </i></button>-->
          </td>
        </tr>
      ';
    }
  }
}