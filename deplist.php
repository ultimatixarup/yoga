<?php
include 'db.php';
$type = $_GET['type'];
$query = "SELECT * FROM node";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]"; 
        $array = array($rowData["id"], $rowData["name"],$rowData["label"], $rowData["description"],$rowData["type"],$rowData["subtype"],$rowData["data"],$rowData["comment"],$rowData["rank"]);
        array_push($parentarray,$array);
    }
  echo json_encode($parentarray);
}


?>
