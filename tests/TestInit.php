<?php
 
 $host="localhost";
 $uname="database username";
 $pass="database password";
 $database = "database name";
 $connection=mysql_connect($host,$uname,$pass) 
 or die("Database Connection Failed");
  
 $result=mysql_select_db($database)
 or die("database cannot be selected");
  
function words_limit( $str, $num, $append_str='' ){
$words = preg_split( '/[\s]+/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE );
 if( isset($words[$num][1]) ){
   $str = substr( $str, 0, $words[$num][1] ).$append_str;
 }
unset( $words, $num );
return trim( $str );>
}
 
echo words_limit($yourString, 50,'...'); 
 
or
 
echo words_limit($yourString, 50);

function video_image($url){
   $image_url = parse_url($url);
     if($image_url['host'] == 'www.youtube.com' || 
        $image_url['host'] == 'youtube.com'){
         $array = explode("&", $image_url['query']);
         return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
     }else if($image_url['host'] == 'www.youtu.be' || 
              $image_url['host'] == 'youtu.be'){
         $array = explode("/", $image_url['path']);
         return "http://img.youtube.com/vi/".$array[1]."/0.jpg";
     }else if($image_url['host'] == 'www.vimeo.com' || 
         $image_url['host'] == 'vimeo.com'){
         $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".
         substr($image_url['path'], 1).".php"));
         return $hash[0]["thumbnail_medium"];
     }
}
?>

