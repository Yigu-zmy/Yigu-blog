<?php
function readable_random_string($length = 6){ 
    $conso=array("b","c","d","f","g","h","j","k","l", 
    "m","n","p","r","s","t","v","w","x","y","z"); 
    $vocal=array("a","e","i","o","u"); 
    $password=""; 
    srand ((double)microtime()*1000000); 
    $max = $length/2; 
    for($i=1; $i<=$max; $i++) 
    { 
    $password.=$conso[rand(0,19)]; 
    $password.=$vocal[rand(0,4)]; 
    } 
    return $password; 
}  


function generate_rand($l){ 
  $c= "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; 
  srand((double)microtime()*1000000); 
  for($i=0; $i<$l; $i++) { 
      $rand.= $c[rand()%strlen($c)]; 
  } 
  return $rand; 
}  

function encode_email($email=¡¯info@domain.com¡¯, $linkText=¡¯Contact Us¡¯, $attrs =¡¯class="emailencoder"¡¯ ) 
{ 
    // remplazar aroba y puntos 
    $email = str_replace(¡¯@¡¯, ¡¯&#64;¡¯, $email); 
    $email = str_replace(¡¯.¡¯, ¡¯&#46;¡¯, $email); 
    $email = str_split($email, 5);   

    $linkText = str_replace(¡¯@¡¯, ¡¯&#64;¡¯, $linkText); 
    $linkText = str_replace(¡¯.¡¯, ¡¯&#46;¡¯, $linkText); 
    $linkText = str_split($linkText, 5);   

    $part1 = ¡¯<a href="ma¡¯; 
    $part2 = ¡¯ilto&#58;¡¯; 
    $part3 = ¡¯" ¡¯. $attrs .¡¯ >¡¯; 
    $part4 = ¡¯</a>¡¯;   

    $encoded = ¡¯<script type="text/javascript">¡¯; 
    $encoded .= "document.write(¡¯$part1¡¯);"; 
    $encoded .= "document.write(¡¯$part2¡¯);"; 
    foreach($email as $e) 
    { 
            $encoded .= "document.write(¡¯$e¡¯);"; 
    } 
    $encoded .= "document.write(¡¯$part3¡¯);"; 
    foreach($linkText as $l) 
    { 
            $encoded .= "document.write(¡¯$l¡¯);"; 
    } 
    $encoded .= "document.write(¡¯$part4¡¯);"; 
    $encoded .= ¡¯</script>¡¯;   

    return $encoded; 
}  

function is_valid_email($email, $test_mx = false) 
{ 
    if(eregi("^([_a-z0-9-]+)(.[_a-z0-9-]+)*@([a-z0-9-]+)(.[a-z0-9-]+)*(.[a-z]{2,4})$", $email)) 
        if($test_mx) 
        { 
            list($username, $domain) = split("@", $email); 
            return getmxrr($domain, $mxrecords); 
        } 
        else 
            return true; 
    else 
        return false; 
}  

function list_files($dir) 
{ 
    if(is_dir($dir)) 
    { 
        if($handle = opendir($dir)) 
        { 
            while(($file = readdir($handle)) !== false) 
            { 
                if($file != "." && $file != ".." && $file != "Thumbs.db") 
                { 
                    echo ¡¯<a target="_blank" href="¡¯.$dir.$file.¡¯">¡¯.$file.¡¯</a><br>¡¯."n"; 
                } 
            } 
            closedir($handle); 
        } 
    } 
}  

function destroyDir($dir, $virtual = false) 
{ 
    $ds = DIRECTORY_SEPARATOR; 
    $dir = $virtual ? realpath($dir) : $dir; 
    $dir = substr($dir, -1) == $ds ? substr($dir, 0, -1) : $dir; 
    if (is_dir($dir) && $handle = opendir($dir)) 
    { 
        while ($file = readdir($handle)) 
        { 
            if ($file == ¡¯.¡¯ || $file == ¡¯..¡¯) 
            { 
                continue; 
            } 
            elseif (is_dir($dir.$ds.$file)) 
            { 
                destroyDir($dir.$ds.$file); 
            } 
            else 
            { 
                unlink($dir.$ds.$file); 
            } 
        } 
        closedir($handle); 
        rmdir($dir); 
        return true; 
    } 
    else 
    { 
        return false; 
    } 
}  

?>