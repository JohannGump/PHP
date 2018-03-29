<html>
    <head>
        <meta charset="utf-8" />
        <title>FichierAfficher.php</title>
    </head>

    <body>
        <form method="POST" action="">
            <label>Code : </label>
            <input type="text" name="code" value="5" size="5" />
            <input type="submit" />
        </form>

        <?php
        // --- On supprime un personnage en fonction de son code
        // --- Structure du fichier code;nom;cp
        $code = filter_input(INPUT_POST, "code");
        if ($code != null) {
            $lsNomFichier = "personnages.txt";
            $t = file($lsNomFichier);

            $lbTrouve = false;
            $i = 0;
            $compte = count($t);
            while ($i < $compte && !$lbTrouve) {
                $tChamps = explode(";", $t[$i]);
                if ($tChamps[0] == $code) {
                    $lbTrouve = true;
                }
                $i++;
            } /// Recherche

            if ($lbTrouve) {
                // --- Efface et remplace une portion de tableau
                array_splice($t, $i - 1, 1);
                file_put_contents($lsNomFichier, $t);
                echo "Enregistrement supprimé";
            } /// SI trouve
            else {
                echo "Introuvable";
            } /// PAS trouve
        } ///
        ?>
    </body>
</html>
