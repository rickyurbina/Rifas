<?php
class calcula{
    function oportunidades($boleto){

        if ($boleto <= 834){
            $segunda = 3335-$boleto;
            $tercera = $boleto + 5834;
            $cuarta = 9169 - $boleto;
        }
        else if ($boleto >= 835 && $boleto <= 1668){
            $segunda = 4168 - ($boleto - 835);
            $tercera = $boleto + 4166;
            $cuarta = $segunda + 4166;
        }
        else if ($boleto >= 1669 && $boleto <= 2500){
            $segunda = 5000 - ($boleto - 1669);
            $tercera = $boleto + 5000;
            $cuarta = $segunda + 5000;
            if ($cuarta == 10000) $cuarta = '0000';
        }
        // $oportunidades = $boleto . " - " . $segunda . " - " . $tercera . " - " . $cuarta;
        $oportunidades = $boleto <= 1000 ? '0' : '';
        $oportunidades = $oportunidades . "$boleto - $segunda - $tercera - $cuarta";
        echo $oportunidades;
    }

    function oportunidadesRetorno($boleto) {
        if ($boleto <= 834){
            $segunda = 3335-$boleto;
            $tercera = $boleto + 5834;
            $cuarta = 9169 - $boleto;
        }
        else if ($boleto >= 835 && $boleto <= 1668){
            $segunda = 4168 - ($boleto - 835);
            $tercera = $boleto + 4166;
            $cuarta = $segunda + 4166;
        }
        else if ($boleto >= 1669 && $boleto <= 2500){
            $segunda = 5000 - ($boleto - 1669);
            $tercera = $boleto + 5000;
            $cuarta = $segunda + 5000;
            if ($cuarta == 10000) $cuarta = '0000';
        }
        // $oportunidades = $boleto . " - " . $segunda . " - " . $tercera . " - " . $cuarta;
        $oportunidades = $boleto <= 1000 ? '0' : '';
        $oportunidades = $oportunidades . "$boleto - $segunda - $tercera - $cuarta";
        return $oportunidades;
    }
}
