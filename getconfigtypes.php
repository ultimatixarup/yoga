<?php
include 'db.php';

$source = $_GET["source"];
$parentarray = array();


$query1 = "SELECT * FROM configuration where source='$source' and disabled='N' order by rank";

$res1 = mysql_query($query1);

if(mysql_num_rows($res1)!=0) {
    while($rowData1 = mysql_fetch_assoc($res1)) {
        
        $dest = $rowData1["destination"];
        
        $istype = $rowData1["istype"];
        $issubtype = $rowData1["issubtype"];
        $istypeorsubtype = false;
       
        
        if($istype == "true"){
            $query = "select * from node where type='$dest' order by rank";
            $istypeorsubtype = true;
        }else if($issubtype == "true"){
            $query = "select * from node where subtype='$dest' order by rank";
            $istypeorsubtype = true;
        }else {
            $query = "select * from node where name='$dest' order by rank";
            $istypeorsubtype = true;
        }
       
        
        $res = mysql_query($query);
        while($rowData = mysql_fetch_assoc($res)){
         
       
              
          
              $array = array($rowData['name'],$rowData['description'],$rowData['data'],'http://bsswest.org/yoga/icons/' . preg_replace('/\s+/', '', $rowData['name']) . '.jpeg',$rowData['type'],$rowData['label']);
        
           
            array_push($parentarray,$array);
         
            
        }
        
     //echo "[$rowData['id']$,rowData['name']]"; 
       
    
}
}
 echo json_encode($parentarray);


?>
