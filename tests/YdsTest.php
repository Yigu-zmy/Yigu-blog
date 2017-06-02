<?php

$json_string=¡¯{"id":1,"name":"foo","email":"foo@foobar.com","interest":["wordpress","php"]} ¡¯; 
$obj=json_decode($json_string); 
echo $obj->name; //prints foo 
echo $obj->interest[1]; //prints php   

//xml string 
$xml_string="<?xml version=¡¯1.0¡¯?> 
<users> 
<user id=¡¯398¡¯> 
<name>Foo</name> 
<email>foo@bar.com</name> 
</user> 
<user id=¡¯867¡¯> 
<name>Foobar</name> 
<email>foobar@foo.com</name> 
</user> 
</users>";  

//load the xml string using simplexml 
$xml = simplexml_load_string($xml_string);  

//loop through the each node of user 
foreach ($xml->user as $user) 
{ 
//access attribute 
echo $user[¡¯id¡¯], ¡¯ ¡¯; 
//subnodes are accessed by -> operator 
echo $user->name, ¡¯ ¡¯; 
echo $user->email, ¡¯<br />¡¯; 
}  


function create_slug($string){ 
$slug=preg_replace(¡¯/[^A-Za-z0-9-]+/¡¯, ¡¯-¡¯, $string); 
return $slug; 
}  


function getRealIpAddr() 
{ 
    if (!emptyempty($_SERVER[¡¯HTTP_CLIENT_IP¡¯])) 
    { 
        $ip=$_SERVER[¡¯HTTP_CLIENT_IP¡¯]; 
    } 
    elseif (!emptyempty($_SERVER[¡¯HTTP_X_FORWARDED_FOR¡¯])) 
    //to check ip is pass from proxy 
    { 
        $ip=$_SERVER[¡¯HTTP_X_FORWARDED_FOR¡¯]; 
    } 
    else 
    { 
        $ip=$_SERVER[¡¯REMOTE_ADDR¡¯]; 
    } 
    return $ip; 
}  

/******************** 
*@file - path to file 
*/ 
function force_download($file) 
{ 
if ((isset($file))&&(file_exists($file))) { 
header("Content-length: ".filesize($file)); 
header(¡¯Content-Type: application/octet-stream¡¯); 
header(¡¯Content-Disposition: attachment; filename="¡¯ . $file . ¡¯"¡¯); 
readfile("$file"); 
} else { 
echo "No file selected"; 
} 
} 

function getCloud( $data = array(), $minFontSize = 12, $maxFontSize = 30 ) 
{ 
$minimumCount = min( array_values( $data ) ); 
$maximumCount = max( array_values( $data ) ); 
$spread = $maximumCount - $minimumCount; 
$cloudHTML = ¡¯¡¯; 
$cloudTags = array();  

$spread == 0 && $spread = 1;  

foreach( $data as $tag => $count ) 
{ 
$size = $minFontSize + ( $count - $minimumCount ) 
* ( $maxFontSize - $minFontSize ) / $spread; 
$cloudTags[] = ¡¯<a style="font-size: ¡¯ . floor( $size ) . ¡¯px¡¯ 
. ¡¯" href="#" title="¡¯¡¯ . $tag . 
¡¯¡¯ returned a count of ¡¯ . $count . ¡¯">¡¯ 
. htmlspecialchars( stripslashes( $tag ) ) . ¡¯</a>¡¯; 
}  

return join( "n", $cloudTags ) . "n"; 
} 
/************************** 
**** Sample usage ***/ 
$arr = Array(¡¯Actionscript¡¯ => 35, ¡¯Adobe¡¯ => 22, ¡¯Array¡¯ => 44, ¡¯Background¡¯ => 43, 
¡¯Blur¡¯ => 18, ¡¯Canvas¡¯ => 33, ¡¯Class¡¯ => 15, ¡¯Color Palette¡¯ => 11, ¡¯Crop¡¯ => 42, 
¡¯Delimiter¡¯ => 13, ¡¯Depth¡¯ => 34, ¡¯Design¡¯ => 8, ¡¯Encode¡¯ => 12, ¡¯Encryption¡¯ => 30, 
¡¯Extract¡¯ => 28, ¡¯Filters¡¯ => 42); 
echo getCloud($arr, 12, 36);  

similar_text($string1, $string2, $percent); 
//$percent will have the percentage of similarity  

?>