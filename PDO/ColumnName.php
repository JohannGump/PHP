<?php

// --- GetColumNamesFromCursor.php
header("Content-Type: text/html; charset=UTF-8");

try {
    $lcnx = new PDO("mysql:host=localhost;port=3306;dbname=cours;", "root", "");
    $lcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $lcnx->exec("SET NAMES 'UTF8'");

    $table ="pays";
    $lrs = $lcnx->query("SELECT * FROM villes");
    $lrs->setFetchMode(PDO::FETCH_ASSOC);

    // Initialisations
    $lsContenu = "";
    $lsEntetes = "";

    // Le premier enregistrement pour récupérer les noms des colonnes et les valeurs
    $ligne = $lrs->fetch();
    foreach ($ligne as $colonne => $valeur) {
        $lsEntetes .= $colonne . ";";
        $lsContenu .= $valeur . ";";
    }
    // On enlève le dernier ;
    $lsEntetes = substr($lsEntetes, 0, -1);
    $lsContenu = substr($lsContenu, 0, -1);
    $lsEntetes .= "\n";
    $lsContenu .= "\n";

    // On boucle sur les lignes à partir de la 2ème
    while ($ligne = $lrs->fetch()) {
        // On boucle sur les colonnes, on ne récupère que les valeurs
        foreach ($ligne as $valeur) {
            // On recupere les valeurs des colonnes
            $lsContenu .= $valeur . ";";
        }
        // On enleve le dernier ;
        $lsContenu = substr($lsContenu, 0, -1);
        // On ajoute le separateur d'enr
        $lsContenu .= "\n";
    }

    $lrs->closeCursor();

    // On place les entetes avant le contenu
    $lsContenu = $lsEntetes . $lsContenu;

    // Affichage
    echo nl2br($lsContenu);
} catch (PDOException $e) {
    echo "Echec de l'exécution : " . $e->getMessage();
}

$lcnx = null;
// Et pour mettre en CSV
file_put_contents("$table.csv", $lsContenu);
?>

