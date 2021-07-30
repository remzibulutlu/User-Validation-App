<?php

try {

    $istek = new SoapClient('https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL');

    print_r($istek->__getFunctions());

    echo "<hr />";

    print_r($istek->__getTypes());

    echo "<hr />";
    
} catch (Exception $exc) {

    echo $exc->getMessage();
}

?>