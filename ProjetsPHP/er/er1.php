<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$tel = "01-12-03-04-05";
//$motif = "@([0-9]{2}-){4}[0-9]{2}@";
$motif = "@^0[1-9](-[0-9]{2}){4}@";
echo preg_match($motif, $tel); //Affiche 1 -0

?>