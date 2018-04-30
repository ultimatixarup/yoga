<?php
include 'db.php';
$type = $_GET['type'];
$query = "select distinct type from node";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]"; 
        array_push($parentarray,$rowData['type']);
    }
  echo json_encode($parentarray);
}
?>
