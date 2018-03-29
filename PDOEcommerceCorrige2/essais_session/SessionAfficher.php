<?php

// --- SessionAfficher.php
header("Content-Type: text/html;charset=UTF-8");
session_start();
$bExists = array_key_exists("prenom", $_SESSION);
if ($bExists) {
    echo "Variable <strong>prenom</strong> : " . $_SESSION["prenom"];
} else {
    echo "Variable <strong>prenom</strong> inexistante";
}
?>