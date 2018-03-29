<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once './Personne.php';

$p1 = new Personne();
$p1->setNom("Tintin");
$p1->setAge(33);

echo $p1->getNom() . " a " . $p1->getAge() . " ans";
 ?>