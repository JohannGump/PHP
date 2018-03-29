<?php

// --- SessionDetruire.php
header("Content-Type: text/html;charset=UTF-8");
session_start();
$bExists = array_key_exists("prenom", $_SESSION);
if ($bExists) {
    echo "<br/>Destruction de la variable de session <strong>prenom</strong>";
    unset($_SESSION["prenom"]);
    $_SESSION = array();
} else {
    echo "Variable <strong>prenom</strong> inexistante";
}
?>