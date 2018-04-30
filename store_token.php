<?php

include 'db.php';

$token = $_GET['token'];


$sql_select = "select * from device_tokens where token='" . $token . "'";

 $result = mysql_query($sql_select);
 $num_rows = mysql_num_rows($result);
 
 if($num_rows == 0)
{
 $sql_select = "insert into device_tokens (token) values ('" . $token . "')";

 $result = mysql_query($sql_select);
}
 $sql_select = "select * from device_tokens";

 $result = mysql_query($sql_select);
 



  $data = array();
  $tempdata = "";
  while($row = mysql_fetch_array($result)){
   
   $tempdata =  array($row['token']);
    $tempjson = json_encode($tempdata);
    $data[] = $tempdata;
    
  }

  echo json_encode($data) ; 
   






			
			echo $data;
			
?>