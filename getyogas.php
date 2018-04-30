<?php
include 'db.php';
$type = $_GET['type'];
$query2 = "select distinct  label,name,description,data,type from node where type='disease'";
$res2 = mysql_query($query2);
if(mysql_num_rows($res2)!=0) {
    $parentarray = array();
    while($rowData2 = mysql_fetch_assoc($res2)) {
     //echo "[$rowData['id']$,rowData['name']]";
     if(substr($rowData2['label'],0,3)!='UC-'){
     
        //$row2 = array($rowData2['label'],$rowData['description'],$rowData['data'],'http://bsswest.org/yoga/icons/' . preg_replace('/\s+/', '', $rowData['name']) . '.jpeg',$rowData['type'],$rowData['name'] );
       $name =  $rowData2['name'];
       //echo $name;
       $query1 = "SELECT * FROM configuration where source='$name' and disabled='N' order by rank";
       //echo $query1;
        $res1 = mysql_query($query1);
        $subarray = array();
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
                    $iconname = str_replace(".3gp",".jpg",$rowData['data']);
                    $iconname = str_replace(".mp4",".jpg",$iconname); 
                    $array = array($rowData['name'],$rowData['description'],$rowData['data'], $iconname,$rowData['type'],$rowData['label'],$rowData['video_easy']);
        
                    array_push($subarray,$array);
         
            
        }
        
     //echo "[$rowData['id']$,rowData['name']]"; 
       
    
}
}
        
       $parentarray[$name]=$subarray;
     }
     }
    
  echo json_encode($parentarray);
}
?>
