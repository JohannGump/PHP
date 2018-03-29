<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>RechercheCommuneViaCP</title>
    </head>
    <body>
        <form action="" method="get">
            <label>CP ? </label>
            <input name="cp" type="text" value="" />
            <input type="submit" />
        </form>
        <br>

        <?php
        $lsMessage = "";
        $cp = filter_input(INPUT_GET, "cp");
        if ($cp != null) {
            $lsFichier = "communes.csv";
            if (!file_exists($lsFichier)) {
                $lsMessage = "Le fichier $lsFichier n'existe pas !";
            } else {

                // --- Ouverture du fichier et transfert dans un tableau
                $tEnregistrements = file($lsFichier);
                // --- Initialisation de la chaîne résultat
                $resultat = "";
                // --- Parcours des n lignes du tableau
                $compte = count($tEnregistrements);
                for ($i = 0; $i < $compte; $i++) {
                    // --- "Explosion" de l'enregistrement
                    $tChamps = explode(";", $tEnregistrements[$i]);
                    // --- Comparaison du 2ème élément à la valeur saisie
                    if ($tChamps[1] == $cp) {
                        // --- Récupération du nom de la commune
                        $resultat .= $tChamps[0] . "<br/>";
                    }
                }
                // --- Si résulat est vide ...
                if ($resultat == "") {
                    $lsMessage = "CP inexistant";
                } else {
                    $lsMessage = $resultat;
                }
            }
        } else {
            if (isSet($cp)) {
                $lsMessage = "Veuillez saisir un CP !!!";
            }
        }

        echo $lsMessage;
        ?>

    </body>
</html>
