<?php

$entityBody = file_get_contents('php://input');
$jsonElement = json_decode($entityBody);
echo $jsonElement;
echo base64_encode ($jsonElement );


?>
