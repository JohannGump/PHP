<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cp = "750111";
$motif = "/^[0-9]{5}$/";

echo "<hr>Avec ER<br>";
$debut = time();
for ($i = 1; $i <= 10000000; $i++) {
    $ok = preg_match($motif, $cp);
}
$fin = time();

$duree = $fin - $debut;

echo $debut . "<br>";
echo $fin . "<br>";
echo "Durée : " . $duree;
echo "<br>OK ? $ok";



echo "<hr>Sans ER<br>";
$debut = time();

for ($i = 1; $i <= 10000000; $i++) {
    $longueur = strlen($cp);
    if ($longueur == 5) {
        if (is_numeric($cp)) {
            $ok = 1;
        } else {
            $ok = 0;
        }
    } else {
        $ok = 0;
    }
}

$fin = time();

$duree = $fin - $debut;

echo $debut . "<br>";
echo $fin . "<br>";
echo "Durée : " . $duree;
echo "<br>OK ? $ok";
?>

