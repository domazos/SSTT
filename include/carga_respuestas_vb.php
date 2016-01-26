<?php

require("../class/Contratos.php");

$contrato = new Contratos;

echo $contrato->listarRespuestasTipoRechazo(0);

?>