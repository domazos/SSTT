<?php

require("class/Contratos.php");

$contrato = new Contratos;

$contrato->generaOrdenPDF(3, 5);

?>