<?php

/*
 * ConnexionTest.php
 */
require_once '../lib/Connexion.php';

$lcnx = seConnecter("../conf/cours.ini");

echo "<br><pre>";
var_dump($lcnx);
echo "</pre><br>";

if ($lcnx == null) {
    echo "La connexion est nulle !!!";
} else {
    seDeconnecter($lcnx);
}
?>
