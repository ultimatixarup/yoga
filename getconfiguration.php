<?php
include 'db.php';

$source = $_GET["source"];
$parentarray = array();


$query1 = "SELECT * FROM configuration where source='$source' order by disabled";

$res1 = mysql_query($query1);

if(mysql_num_rows($res1)!=0) {
    while($rowData = mysql_fetch_assoc($res1)) {
        $array = array($rowData["source"],$rowData["destination"],$rowData["istype"],$rowData["rank"],$rowData["disabled"]);
        array_push($parentarray,$array); 
    }
}
 echo json_encode($parentarray);


?>
