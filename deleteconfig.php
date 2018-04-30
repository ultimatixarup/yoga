<?php
include 'db.php';

$src = $_GET["src"];
$dest=$_GET["dest"];



mysql_query("delete from configuration where source='$src' and destination='$dest'");
mysql_query('commit');

$query = "SELECT * FROM configuration";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]"; 
        $array = array($rowData["source"], $rowData["destination"]);
        array_push($parentarray,$array);
    }
  echo json_encode($parentarray);
}



?>
