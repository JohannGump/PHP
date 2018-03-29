<?php

/*
 * Metafile.php
 * Mode : OO
 */
require_once '../lib/Metafile.php';

$t = Metafile::getFiles("../ressources/", "csv");
foreach ($t as $value) {
    echo "$value<br>";
}

echo "<hr>";
$t = Metafile::getHeaders("../ressources/Ville.csv", ";");
foreach ($t as $value) {
    echo "$value<br>";
}
?>
