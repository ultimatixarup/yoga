<?php
include 'db.php';


$disabled = $_GET["disabled"];
$source = $_GET["source"];
$destination = $_GET["destination"];

$query= "update configuration set disabled='$disabled' where source='$source' and destination='$destination'";

mysql_query($query);
mysql_query('commit');
echo $query;

?>