<?php
include 'db.php';
$type = $_GET['type'];
$subtype = $_GET['subtype'];
$query = "select distinct  name,description,data,type from node where type='$type' and subtype='$subtype'";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]";
        $row = array($rowData['name'],$rowData['description'],$rowData['data'],'http://bsswest.org/yoga/yoga.png',$rowData['type']);
        array_push($parentarray,$row);
    }
  echo json_encode($parentarray);
}
?>
