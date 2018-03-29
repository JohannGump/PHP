<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo preg_match("@[0-9]{5}@", "7501"); // Affiche 1 ou 0
echo "<hr>";

echo preg_match("@^[0-9]{5}$@", "7501", $tResultat) ? "CP" : "Pas CP"; // TRUE
echo "<hr>";
var_dump($tResultat);

echo "<hr>";

$tel = "01-02-03-04-05";
$motif = "@([0-9]{2}-){4}[0-9]{2}@";
echo preg_match($motif, $tel); // Affiche 1 ou 0

echo "<hr>";
$tel = "01-02-03-04-05";
$motif = "@0[1-9](-[0-9]{2}){4}@";
echo preg_match($motif, $tel); // Affiche 1 ou 0


?>