<?php

/*
 * MetabaseTest.php
 * Mode : OO
 */
require_once '../lib/Connexion.php';
require_once '../lib/Metabase.php';

$lcnx = Connexion::seConnecter("../conf/bd.ini");

$t = Metabase::getBDsFromServeur($lcnx);
foreach ($t as $value) {
    echo "$value<br>";
}

echo "<hr>";
$t = Metabase::getTablesFromBD($lcnx, "cours");
foreach ($t as $value) {
    echo "$value<br>";
}

echo "<hr>";
$t = Metabase::getColumnsNamesFromTable($lcnx, "cours", "ville");
foreach ($t as $value) {
    echo "$value<br>";
}

Connexion::seDeconnecter($lcnx);
?>
