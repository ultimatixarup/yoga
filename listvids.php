<?php
$dir    = '../yogamedia/';
$files = scandir($dir);

//unset($files[0]);
//unset($files[1]);
array_splice($files, 0, 2);
echo(json_encode($files));

?>