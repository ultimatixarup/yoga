<?php
include 'db.php';
$type = $_GET['type'];
$query = "select distinct subtype from node where type='$type'";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]";
        $row = array($rowData['subtype']);
        array_push($parentarray,$row);
    }
  echo json_encode($parentarray);
}
?>