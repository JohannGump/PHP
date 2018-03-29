<?php

//check si récupération en GET ou POST
$action = filter_input(INPUT_GET, "action");

if($action == null){
    $action = filter_input(INPUT_POST, "action");
}

switch ($action){
    
    case "insert":    
        include "../boundaries/Insert.php";
        break;
    
    case "insertValidation":    
        include "../boundaries/Insert.php";
        break;
           
    case "drop":
        include "../boundaries/Drop.php";
        break;  
      
    case "create":
        include "../boundaries/Create.php";
        break;
    
    case "select":
        include "../boundaries/Select.php";
        break;

}

