<?php
include 'db.php';
$inputJSON = file_get_contents('php://input');
$input= json_decode( $inputJSON, TRUE ); //convert JSON into array

$name = $input["name"];
$video=$input["video"];
$mode=$input["easy"];
$vidname = "";
if($mode == "true"){
    mysql_query("update node set video_easy='$video' where name='$name'");
     
} else if($mode == "false") {
     mysql_query("update node set data='$video' where name='$name'");
}
     mysql_query('commit');
     echo "Vido linked successfully!";
 

?>
