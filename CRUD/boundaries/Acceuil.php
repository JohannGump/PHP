<html>
    <head>
        <meta charset="utf-8" />
        <title>Accueil</title>
    </head>

    <body>

    <section>
        <form action="../controls/MainControl.php" method="GET">
            <select name="fileChoice" size="5">
                <?php
                // rechercher les fichiers du dossier ressources

                header("Content-Type: text/html;charset=UTF-8");
                $lsChemin = "../ressources/";

                // --- "Ouverture" du repertoire
                $loDossier = opendir($lsChemin);

                // --- Pointage sur la premiere entree
                // --- readdir renvoie la premiere entree puis la suivante et enfin faux lorsqu'il n'y a plus d'entrees
                // --- Affichage du nom du fichier (ou sous-répertoire)

                while ($lsNomFichier = readdir($loDossier)) {
                    // Récupération des txt et des csv uniquement
                    $path_parts = pathinfo($lsNomFichier);
                    if ($path_parts['extension'] == "csv" || $path_parts['extension'] == "txt") {
                        echo "<option>$lsNomFichier</option>";
                    }
                }

                // --- Fermeture
                closedir($loDossier);
                ?>
            </select>

            <p></p>     


            <input type="submit" value="select" name="action">
            <input type="submit" value="insert" name="action">
            <p></p>
            <label>Séparateur : </label>
            <input type="text" name="separateur" value=";" size="3" />
            <p></p>
            <input type="submit" value="create" name="action">
            <input type="submit" value="drop" name="action"> 

        </form> 
    </section>    
    </body>
</html>