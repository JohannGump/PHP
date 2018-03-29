<?php
$age = filter_input(INPUT_GET, "age");
$lsmessage = "";
if ($age == null){
    if (empty($age)){
        $lsmessage = "entrez l'âge";
    } else {
        $lsmessage = "passez par le formulaire";
    }
} else if (is_numeric($age)){ 
    if ($age > "0"){
        if ($age < "18"){
          $lsmessage = "dégage puceau";
        }else{
            $lsmessage = "Bienvenue";
        }
    } else {
      $lsmessage = "entrez un nombre positif";  
    }
} else {
    $lsmessage = "Rentrez un nombre";
}   

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include "./controleAgeIHM.php";
?>
