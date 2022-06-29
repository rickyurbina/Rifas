<?php

?>
<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h5>Agregar sorteo</h5>
        </div>
        <div class="card-body">
          <form class="theme-form" method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
              <div class="col-2" style="position: relative;">
                <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen('img-0')"></i>
                <img id="img-0" class="img-form" onclick="document.getElementById('input-img-0').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                <input type="file" accept="image/*" name="input-img-0" id="input-img-0" hidden onchange="previsualizarImagen(event, 'img-0')">
              </div>
              <div class="col-2">
                <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen('img-1')"></i>
                <img id="img-1" class="img-form" onclick="document.getElementById('input-img-1').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                <input type="file" accept="image/*" name="input-img-1" id="input-img-1" hidden onchange="previsualizarImagen(event, 'img-1')">
              </div>
              <div class="col-2">
                <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen('img-2')"></i>
                <img id="img-2" class="img-form" onclick="document.getElementById('input-img-2').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                <input type="file" accept="image/*" name="input-img-2" id="input-img-2" hidden onchange="previsualizarImagen(event, 'img-2')">
              </div>
              <div class="col-2">
                <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen('img-3')"></i>
                <img id="img-3" class="img-form" onclick="document.getElementById('input-img-3').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                <input type="file" accept="image/*" name="input-img-3" id="input-img-3" hidden onchange="previsualizarImagen(event, 'img-3')">
              </div>
              <div class="col-2">
                <i class="fas fa-times cerrar" style="position: absolute; z-index: 2; right: 1.5em; top: 0.5em; font-size: 18px; cursor: pointer;" onclick="removeImagen('img-4')"></i>
                <img id="img-4" class="img-form" onclick="document.getElementById('input-img-4').click();" src="http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg">
                <input type="file" accept="image/*" name="input-img-4" id="input-img-4" hidden onchange="previsualizarImagen(event, 'img-4')">
              </div>

            </div>
            <br>
            <br>
            <br>
            <div class="row">
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaTituloSorteo">Título:</label>
                  <input type="text" name="cajaTituloSorteo" id="cajaTituloSorteo" class="form-control" required>
                </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                  <div class="form-group">
                    <label for="col-form-label pt-9" for="cajaSubtituloSorteo">Subtítulo:</label>
                    <input type="text" name="cajaSubtituloSorteo" id="cajaSubtituloSorteo" class="form-control" required>
                  </div>
              </div>
              <div class="col-md-4 col-lg-4 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaFechaSorteo">Fecha:</label>
                  <input type="date" name="cajaFechaSorteo" id="cajaFechaSorteo" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-6 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaNoBoletos">Número de boletos:</label>
                  <input type="number" name="cajaNoBoletos" id="cajaNoBoletos" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaPrecioBoleto">Costo del boleto:</label>
                  <input type="number" name="cajaPrecioBoleto" id="cajaPrecioBoleto" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-lg-6 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaSegundoLugar">Premio segundo lugar:</label>
                  <input type="text" name="cajaSegundoLugar" id="cajaSegundoLugar" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6 col-lg-6 col-12">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaTercerLugar">Premio tercer lugar</label>
                  <input type="text" name="cajaTercerLugar" id="cajaTercerLugar" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaDescripcionSorteo">Caracteristicas premio principal:</label>
                  <textarea name="cajaDescripcionSorteo" id="cajaDescripcionSorteo" class="form-control" required></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label class="col-form-label pt-0" for="cajaAdicionalesSorteo">Premios adicionales del primer lugar:</label>
                  <textarea name="cajaAdicionalesSorteo" id="cajaAdicionalesSorteo" class="form-control" required></textarea>
                </div>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-8">
                <button class="btn btn-secondary btn-block">Guardar</button>
              </div>
            </div>
            <?php
            $controllerSorteos = new SorteosController();
            $controllerSorteos->ctrAgregarSorteo();
            ?>
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
    document.getElementById(idImg).src = 'http://www.proconsamx.com/wp-content/uploads/2016/09/ef3-placeholder-image.jpg';
    document.getElementById(`input-${idImg}`).value = '';
  }
</script>