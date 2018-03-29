<?php

/*
 * ConnexionTest.php
 */
require_once '../lib/Connexion.php';

$lcnx = Connexion::seConnecter("../conf/bd.ini");

echo "<br><pre>";
var_dump($lcnx);
echo "</pre><br>";

if ($lcnx == null) {
    echo "La connexion est nulle !!!";
} else {
    Connexion::seDeconnecter($lcnx);
}
?>
