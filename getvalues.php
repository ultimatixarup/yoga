<?php
include 'db.php';
$type = $_GET['type'];
$query = "select distinct  label,name,description,data,type from node where type='$type'";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]";
     if(substr($rowData['label'],0,3)!='UC-'){
     
        $row = array($rowData['label'],$rowData['description'],$rowData['data'],'icons/' . preg_replace('/\s+/', '', $rowData['name']) . '.jpeg',$rowData['type'],$rowData['name'] );
        array_push($parentarray,$row);
     }
     }
    
  echo json_encode($parentarray);
}
?>
