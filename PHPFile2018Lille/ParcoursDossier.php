<?php
    header("Content-Type: text/html;charset=UTF-8");
    $lsChemin = "../ressources";

    // --- "Ouverture" du repertoire
    $loDossier = opendir($lsChemin);

    // --- Pointage sur la premiere entree
    // --- readdir renvoie la premiere entree puis la suivante et enfin faux lorsqu'il n'y a plus d'entrees
    // --- Affichage du nom du fichier (ou sous-répertoire)
    while($lsNomFichier = readdir($loDossier)) {
       echo "$lsNomFichier<br/>";
    }

    // --- Fermeture
    closedir($loDossier);
?>

