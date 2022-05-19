<?php
/* 
class BoletosController {
  function ctlBuscarBoleto($noBoleto){
    $resultado = BoletosModel::mdlBuscarBoleto($noBoleto);

    return $resultado;
  }
  public function ctrListarBoletosOcupados() {
    $boletos = BoletosModel::mdlListarBoletosOcupados();    
    $j = 0;

    echo '
    <div class="row">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="primero-tab" data-toggle="tab" href="#primero" role="tab" aria-controls="primero" aria-selected="true">1 - 500</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="segundo-tab" data-toggle="tab" href="#segundo" role="tab" aria-controls="segundo" aria-selected="false">501 - 1000</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="tercero-tab" data-toggle="tab" href="#tercero" role="tab" aria-controls="tercero" aria-selected="false">1001 - 1500</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="cuarto-tab" data-toggle="tab" href="#cuarto" role="tab" aria-controls="cuarto" aria-selected="false">1501 - 2000</a>
        </li>
      </ul>
    </div>
    ';

    echo '<div class="row bg-white p-5 justify-content-center">
    <div class="tab-content">';

    $pag = 1;

    echo '<div class="tab-pane active" id="primero" role="tabpanel" aria-labelledby="primero-tab">
    <div class="row justify-content-center">';

    for ($i = 0; $i < 500; $i++) {
      if (isset($boletos[$j])) {
        if ($boletos[$j]["noBoleto"] == ($i + 1)) {
        
          echo 
          '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto-comprado m-1" style="padding-right: 0px; padding-left: 0px">
            <div class="card">
              <div class="card-body text-center">' . ($i + 1) . '</div>
            </div>
          </div>';
          $j++;
        } else {
          echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
            <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
          </div>';
        }
      } else {
        echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
          <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
        </div>';
      }
    }

    echo '</div></div>';

    echo '<div class="tab-pane" id="segundo" role="tabpanel" aria-labelledby="segundo-tab">
    <div class="row justify-content-center">';

    for ($i = 500; $i < 1000; $i++) {
      if (isset($boletos[$j])) {
        if ($boletos[$j]["noBoleto"] == ($i + 1)) {
        
          echo 
          '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto-comprado m-1" style="padding-right: 0px; padding-left: 0px">
            <div class="card">
              <div class="card-body text-center">' . ($i + 1) . '</div>
            </div>
          </div>';
          $j++;
        } else {
          echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
            <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
          </div>';
        }
      } else {
        echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
          <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
        </div>';
      }
    }

    echo '</div></div>';

    echo '<div class="tab-pane" id="tercero" role="tabpanel" aria-labelledby="tercero-tab">
    <div class="row justify-content-center">';

    for ($i = 1000; $i < 1500; $i++) {
      if (isset($boletos[$j])) {
        if ($boletos[$j]["noBoleto"] == ($i + 1)) {
        
          echo 
          '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto-comprado m-1" style="padding-right: 0px; padding-left: 0px">
            <div class="card">
              <div class="card-body text-center">' . ($i + 1) . '</div>
            </div>
          </div>';
          $j++;
        } else {
          echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
            <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
          </div>';
        }
      } else {
        echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
          <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
        </div>';
      }
    }

    echo '</div></div>';

    echo '<div class="tab-pane" id="cuarto" role="tabpanel" aria-labelledby="cuarto-tab">
    <div class="row justify-content-center">';

    for ($i = 1500; $i < 2000; $i++) {
      if (isset($boletos[$j])) {
        if ($boletos[$j]["noBoleto"] == ($i + 1)) {
        
          echo 
          '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto-comprado m-1" style="padding-right: 0px; padding-left: 0px">
            <div class="card">
              <div class="card-body text-center">' . ($i + 1) . '</div>
            </div>
          </div>';
          $j++;
        } else {
          echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
            <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
          </div>';
        }
      } else {
        echo '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto text-center m-1" style="padding-right: 0px; padding-left: 0px">
          <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
        </div>';
      }
    }

    echo '</div></div>';

    echo '
      </div>
    </div>';
  }

  public function ctrComprobarBoletoDisponible($noBoleto, $idSorteo) {
    $respuesta = BoletosModel::mdlComprobarBoletoDisponible($noBoleto, $idSorteo);
    
    if (count($respuesta) < 1) {
      return "true";
    } else {
      return "false";
    }
  }
} */