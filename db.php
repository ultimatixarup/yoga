<?php
$con = mysql_connect("yogacure.cqemwfvv8ins.us-east-1.rds.amazonaws.com","yogacure","yogacure");


mysql_select_db("yogacure",$con);

header('Access-Control-Allow-Headers: X-ACCESS_TOKEN, Access-Control-Allow-Origin, Authorization, Origin, x-requested-with, Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Origin: *');
?>
