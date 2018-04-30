<?php
include 'db.php';
$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array

$source = $input["source"];
$destination=$input["destination"];
$type=$input["istype"];
$subtype = $input["issubtype"];


if($type == "true"){
   mysql_query("insert into configuration(source,destination,istype,disabled) values('$source','$destination',$type,'Y')");
   
} else if($subtype == "true") {
   mysql_query("insert into configuration(source,destination,istype,issubtype,disabled) values('$source','$destination',$type,$subtype,'Y')");    
   
} else {
    mysql_query("insert into configuration(source,destination,istype,issubtype,disabled) values('$source','$destination','false','false','Y')");    
    
}


mysql_query('commit');

$query = "SELECT * FROM configuration where source='$source'";
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
