<?php
include 'db.php';
$id = $_GET['id'];
$query = "select name,description,data,type from node where id='$id'";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
   
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]";
        $row = array($rowData['name'],$rowData['description'],$rowData['type'],$rowData['data'],$id);
        echo json_encode($row);
    }
  
}
?>
