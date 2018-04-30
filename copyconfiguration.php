<?php
include 'db.php';
$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array

$source = $input["source"];
$destination=$input["destination"];
$type=$input["istype"];
$subtype = $input["issubtype"];

$query = "SELECT * FROM configuration where source='$destination'";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]"; 
       $dest = $rowData["destination"];
       $istype=$rowData["istype"];
       $rank = $rowData["rank"];
       $issubtype = $rowData["issubtype"];
        mysql_query("insert into configuration(source,destination,istype,issubtype,rank) values('$source','$dest','$istype','$issubtype',$rank)"); 
    }


}

$query = "SELECT * FROM configuration where source='$source'";
$res = mysql_query($query);
if(mysql_num_rows($res)!=0) {
    $parentarray = array();
    while($rowData = mysql_fetch_assoc($res)) {
     //echo "[$rowData['id']$,rowData['name']]"; 
         $array = array($rowData["source"],$rowData["destination"],$rowData["istype"],$rowData["rank"]);
        array_push($parentarray,$array);
    }
  echo json_encode($parentarray);
}


?>
