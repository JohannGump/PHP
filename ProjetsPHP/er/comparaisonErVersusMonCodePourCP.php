<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cp = "75011";
$motif = "/^[0-9]{5}$/";

echo "<hr>Avec ER <hr>";

$debut = microtime(true);

for ($i=1; $i<1000000; $i++){
    $ok = preg_match($motif, $cp);
}

$fin = microtime(true);

$duree = number_format($fin - $debut,10);

echo "Durée :" . $duree;


echo "<hr>Sans ER <hr>";

$debut = microtime(true);

for ($i=1; $i<1000000; $i++){
    if (is_numeric($cp) && strlen($cp) <6){
        $ok = 1;
    } else {
        $ok = 0;
    }
}

$fin = microtime(true);

$duree = number_format($fin - $debut,10);

echo "Durée :" . $duree;

?>
