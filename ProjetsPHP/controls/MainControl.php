<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//check si récupération en GET ou POST
$action = filter_input(INPUT_GET, "action");

if($action == null){
    $action = filter_input(INPUT_POST, "action");
}

switch ($action){
    case "accueil":
        header("location: ../boundaries/Accueil.php");
        break;
    
    case "insert":
        $tMois=array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
        //header("location: ../boundaries/Insert.php");
        include "../boundaries/Insert.php";
        break;
    
    case "insertValidation":
        $tMois=array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
        $lsMessage = "Insertion dans la BD OK"; 
        // on peut faire appel au $lsMessage car include en dessous
        include "../boundaries/Insert.php";
        break;
        
    case "delete":
        //$tVilles = array("Lille", "Paris", "Lyon", "Marseille");
        $tVilles=array();
        $tVilles["59000"]= "Lille";
        $tVilles["75000"]= "Paris";
        $tVilles["69000"]= "Lyon";
        $tVilles["13000"]= "Marseille";
        //header("location: ../boundaries/Delete.php");
        include "../boundaries/Delete.php";
        break;
    
    case "deleteValidation":
        $lsMessage = "Ville choisie";
        include "../boundaries/Delete.php";
        break;
        
    case "update":
        header("location: ../boundaries/Update.php");
        break;
    
    case "select":
        header("location: ../boundaries/Select.php");
        break;
    
    default: 
        header("location: ../boundaries/Accueil.php");
        break;
}
