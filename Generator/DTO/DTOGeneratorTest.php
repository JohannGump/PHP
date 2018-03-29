<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './clientsDTO.php';

$client = new Clients("FR","France");

echo  $fr->getIdPays() . ":" . $fr->getNomPays();

echo "<br>";

$it = new Pays();
$it->setIdPays("IT");
$it->setNomPays("Italie");
echo $it->getIdPays() . ":" . $it->getNomPays();

?>
