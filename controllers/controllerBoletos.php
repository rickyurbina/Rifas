<?php

class BoletosController {
  function ctlBuscarBoleto($noBoleto){
    $resultado = BoletosModel::mdlBuscarBoleto($noBoleto);

    return $resultado;
  }

  
  public function ctrListarBoletosOcupados() {
    $boletos = BoletosModel::mdlListarBoletosOcupados();    
    $j = 0;

    echo '<div class="row bg-white pt-5">';

    $controllerSorteos = new SorteosController();
    $sorteo = $controllerSorteos -> ctrObtenerSorteoActivo();

    for ($i = 0; $i < $sorteo['noBoletos']; $i++) {
      if (isset($boletos[$j])) {
        if ($boletos[$j]["noBoleto"] == ($i + 1)) {
        
          echo 
          '<div class="col-md-2 col-lg-2 col-xl-1 col-3 boleto-comprado" style="padding: 10px;">
            <div class="card">
              <div class="card-body text-center" style="background:black; color:black;"> . </div>
            </div>
          </div>';
          $j++;
        } else {
          echo '<div class="col-md-2 col-lg-2 col-xl-1 col-3 boleto text-center" style="padding: 10px;">
            <button class="btn boton-boleto btn-block" data-id="'.( $i + 1 ).'" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
          </div>';
        }
      } else {
        echo '<div class="col-md-2 col-lg-2 col-xl-1 col-3 boleto text-center" style="padding: 10px;">
          <button class="btn boton-boleto btn-block" onclick="comprarBoleto(' . ($i + 1) . ')">' . ($i + 1) . '</button>
        </div>';
      }
    }

    echo '</div>';
/* 
    echo '<div class="tab-pane" id="segundo" role="tabpanel" aria-labelledby="segundo-tab">
    <div class="row justify-content-center">';

    for ($i = 500; $i < 1000; $i++) {
      if (isset($boletos[$j])) {
        if ($boletos[$j]["noBoleto"] == ($i + 1)) {
        
          echo 
          '<div class="col-md-2 col-lg-2 col-xl-1 col-5 boleto-comprado m-1" style="padding-right: 0px; padding-left: 0px">
            <div class="card">
              <div class="card-body text-center" style="background:black; color:black;"> . </div>
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
              <div class="card-body text-center" style="background:black; color:black;"> . </div>
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
              <div class="card-body text-center" style="background:black; color:black;"> . </div>
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
    */
  } 

  public function ctrComprobarBoletoDisponible($noBoleto, $idSorteo) {
    $respuesta = BoletosModel::mdlComprobarBoletoDisponible($noBoleto, $idSorteo);
    
    if (count($respuesta) < 1) {
      return "true";
    } else {
      return "false";
    }
  }
}