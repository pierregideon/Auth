<?php
// ================================================================================
// "^" pour indiquer le début de la chaine et "$" pour indiquer la fin de la chaine.
// d pour digit
// ================================================================================
$yeaRegexp = "/^\d{4}$/";
$yeaRegexp ="/^[0-9]{4}$/";
$yeaRegexp = "/^[1-2][0-9]{3}$/";
// ===================================
// i pour rendre insensible à la casse
// ===================================
$emailRegexp ="/^[a-z0-9._-]+@[a-zA-Z0-9_-]+\.[a-zA-Z]{2,}$/i";

$usernameRegexp = "/^[a-zA-Z0-9._-]{2,100}$/";
$usernameRegexp ="/^[\p{L}0-9._-]{2,100}$/u";
if(preg_match($usernameRegexp, "djasfl-éeê")){
  echo "match";
}
else{
  echo "no match";
}




?>
