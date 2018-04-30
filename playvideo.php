<?php

$video = $_GET["video"];
$types = explode(".",$video);
$type = $types[1];
if($type == "3gp"){
$type = "3gpp; codecs='mp4v.20.8, samr'";

}
?>

<html>
<body>



<video width="50%" height="50%" controls poster="icons/playicon.png" preload="none"><source src="http://d1dcu4sbskithe.cloudfront.net/<?php echo $video?>"></video>

</body>
</html>
