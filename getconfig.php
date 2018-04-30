<?php
include 'db.php';

$source = $_GET["source"];
$parentarray = array();
        $query = "select * from node where type='$source' order by rank";
        $res = mysql_query($query);
        while($rowData = mysql_fetch_assoc($res)){
            $array = array($rowData["name"],$rowData["description"],$rowData["type"],'http://bsswest.org/yoga/yoga.png',$rowData["data"],$rowData["rank"]);
            array_push($parentarray,$array); 
        }

 echo json_encode($parentarray);


?>
