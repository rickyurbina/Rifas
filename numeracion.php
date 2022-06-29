<?php
class calcula{
    function oportunidades($boleto){
        //Serie A
        if ($boleto <= 5000){            //834  ->   5000
            $segunda = 20001-$boleto;    //3335 ->   20000
            $tercera = $boleto + 35000;  //5834 ->   35001
            $cuarta = 55001 - $boleto;   //9169 ->   55000
        }
        //Serie B
        else if ($boleto >= 5001 && $boleto <= 10000){
            $segunda = 25000 - ($boleto - 5001);
            $tercera = $boleto + 25000;
            $cuarta = $segunda + 25000;
        }
        //Serie C
        else if ($boleto >= 10001 && $boleto <= 15000){
            $segunda = 30000 - ($boleto - 10001);
            $tercera = $boleto + 30000;
            $cuarta = $segunda + 30000;
            //if ($cuarta == 60000) $cuarta = '00000';
        }
        
        if ($boleto <= 9) $oportunidades = '0000';
        elseif ($boleto <= 99) $oportunidades = '000';
        elseif ($boleto <= 999) $oportunidades = '00';
        elseif ($boleto <= 9999) $oportunidades = '0';
    
        $oportunidades = $oportunidades . "$boleto - $segunda - $tercera - $cuarta";
        echo $oportunidades;
    }

    function oportunidadesRetorno($boleto) {
        //Serie A
        if ($boleto <= 5000){            //834  ->   5000
            $segunda = 20001-$boleto;    //3335 ->   20000
            $tercera = $boleto + 35000;  //5834 ->   35001
            $cuarta = 55001 - $boleto;   //9169 ->   55000
        }
        //Serie B
        else if ($boleto >= 5001 && $boleto <= 10000){
            $segunda = 25000 - ($boleto - 5001);
            $tercera = $boleto + 25000;
            $cuarta = $segunda + 25000;
        }
        //Serie C
        else if ($boleto >= 10001 && $boleto <= 15000){
            $segunda = 30000 - ($boleto - 10001);
            $tercera = $boleto + 30000;
            $cuarta = $segunda + 30000;
            //if ($cuarta == 60000) $cuarta = '00000';
        }
        
        if ($boleto <= 9) $oportunidades = '0000';
        elseif ($boleto <= 99) $oportunidades = '000';
        elseif ($boleto <= 999) $oportunidades = '00';
        elseif ($boleto <= 9999) $oportunidades = '0';
        
        $oportunidades = $oportunidades . "$boleto - $segunda - $tercera - $cuarta";
        return $oportunidades;
    }
}
