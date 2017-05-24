<?php

function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {  
    $theta = $longitude1 - $longitude2;  
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));  
    $miles = acos($miles);  
    $miles = rad2deg($miles);  
    $miles = $miles * 60 * 1.1515;  
    $feet = $miles * 5280;  
    $yards = $feet / 3;  
    $kilometers = $miles * 1.609344;  
    $meters = $kilometers * 1000;  
    return compact('miles','feet','yards','kilometers','meters');   
}  
  
$point1 = array('lat' => 40.770623, 'long' => -73.964367);  
$point2 = array('lat' => 40.758224, 'long' => -73.917404);  
$distance = getDistanceBetweenPointsNew($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);  
foreach ($distance as $unit => $value) {  
    echo $unit.': '.number_format($value,4).'  
';  
}  
  
The example returns the following:  
  
miles: 2.6025  
feet: 13,741.4350  
yards: 4,580.4783  
kilometers: 4.1884  
meters: 4,188.3894  

function xcurl($url,$ref=null,$post=array(),$ua="Mozilla/5.0 (X11; Linux x86_64; rv:2.2a1pre) Gecko/20110324 Firefox/4.2a1pre",$print=false) {  
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);  
    if(!empty($ref)) {  
        curl_setopt($ch, CURLOPT_REFERER, $ref);  
    }  
    curl_setopt($ch, CURLOPT_URL, $url);  
    curl_setopt($ch, CURLOPT_HEADER, 0);  
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
    if(!empty($ua)) {  
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);  
    }  
    if(count($post) > 0){  
        curl_setopt($ch, CURLOPT_POST, 1);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);      
    }  
    $output = curl_exec($ch);  
    curl_close($ch);  
    if($print) {  
        print($output);  
    } else {  
        return $output;  
    }  
} 

 100){ 
        $strength = 100; 
    } 
    return $strength; 
} 

var_dump(password_strength("Correct Horse Battery Staple")); 
echo "
"; 
var_dump(password_strength("Super Monkey Ball")); 
echo "
"; 
var_dump(password_strength("Tr0ub4dor&3")); 
echo "
"; 
var_dump(password_strength("abc123")); 
echo "
"; 
var_dump(password_strength("sweet")); 
?>