<?php
list($usec, $sec) = explode(' ', microtime());

$seed = (float) $sec + ((float) $usec * 100000);
srand($seed);
$randval = rand();
echo $randval;

?>