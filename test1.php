<?php 

// where ffmpeg is located, such as /usr/sbin/ffmpeg 
$ffmpeg = '..\ffmpeg'; 

// the input video file 
$video  = '..\yogamedia\9-3-16-shoots 127.mp4'; 

// where you'll save the image 
$image  = '..\yogamedia\thumbnails\demo.jpg'; 

// default time to get the image 
$second = 1; 

// get the duration and a random place within that 
$cmd = "$ffmpeg -i $video 2>&1"; 
if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', $cmd, $time)) { 
    $total = ($time[2] * 3600) + ($time[3] * 60) + $time[4]; 
    $second = rand(1, ($total - 1)); 
} 

// get the screenshot 
$cmd = "$ffmpeg -i $video -deinterlace -an -ss $second -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $image 2>&1"; 
$return = $cmd; 

// done! <img src="http://blog.amnuts.com/wp-includes/images/smilies/icon_wink.gif" alt=";-)" class="wp-smiley"> 
echo 'done!'; 

?>