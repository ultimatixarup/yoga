<?php
include 'db.php';


$rank = $_GET["rank"];
$source = $_GET["source"];
$destination = $_GET["destination"];

$query= "update configuration set rank=$rank where source='$source' and destination='$destination'";

mysql_query($query);
mysql_query('commit');
echo $query;

?>