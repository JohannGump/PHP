<html>
    <head>
        <meta charset="utf-8" />
        <title>FichierAjout1.php</title>
    </head>
    <body>
        <?php
        $code = filter_input(INPUT_POST, "code");
        $nom = filter_input(INPUT_POST, "nom");
        $cp = filter_input(INPUT_POST, "cp");
        if ($code == null || $nom == null || $cp == null) {
            $message = "Passez par le formulaire !!!";
        } else {
            if (empty($code) || empty($nom) || empty($cp)) {
                $message = "Toutes les saisies sont obligatoires !";
            } else {
                $fichier = "personnages.txt";
                // --- Creation et/ou ouverture pour ajout
                $canal = fopen($fichier, "a+");
                // --- Ajout d'un enregistrement
                fwrite($canal, $code . ";" . $nom . ";" . $cp . "\r\n");
                // --- Fermeture du fichier
                fclose($canal);
                $message = "Un personnage a été ajouté dans $fichier";
            }
        }
        ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Code : </label>
            <input type="text" name="code" value="5" size="5" />
            <label>Nom : </label>
            <input type="text" name="nom" value="Tournesol" />
            <label>cp : </label>
            <input type="text" name="cp" value="75011" />
            <input type="submit" />
        </form>

        <label><?php echo $message; ?></label>

    </body>
</html>