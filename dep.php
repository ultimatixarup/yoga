<?php
include 'db.php';
$inputJSON = file_get_contents('php://input');

$input= json_decode( $inputJSON, TRUE ); //convert JSON into array


$name = $input["name"];
$label = $input["label"];
$description=$input["description"];
$type=$input["type"];
$data=$input["data"];
$dataid=$input["dataid"];
$isedit=$input["isedit"];
$subtype=$input["subtype"];
$comment=$input["comment"];

$query="";

if($isedit=="true"){
$query="update node set name='$name',label='$label',description='$description',type='$type',data='$data',subtype='$subtype',comment='$comment' where id=$dataid";
}
else{
$query="insert into node(name,label,description,type,data,subtype,comment) values('$name','$label','$description','$type','$data','$subtype','$comment')";
}

mysql_query($query);
mysql_query('commit');

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
