<?php
include 'db.php';


$rank = $_GET["rank"];
$id = $_GET["id"];


mysql_query("update node set rank=$rank where id='$id'");
mysql_query('commit');
echo "success : rank=$rank. id=$id";

?>
