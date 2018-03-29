<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <title>CSVIHM</title>
    </head>

    <body>
        <header id="header">
            <?php
            include 'partials/Header.php';
            ?>
        </header>

        <nav id="nav">
            <?php
            include 'partials/Nav.php';
            ?>
        </nav>

        <section id='centre'>
            <h1>CSV IHM</h1>

            <section id="bds">
                <form action="../controls/CSVCTRL.php" method="get">
                    <label><strong>Liste des Fichiers</strong></label>
                    <br>
                    <select name="listeFichiers" size="5">
                        <?php
                        /*
                         * 
                         */
                        $lsOptions = "";
                        for ($i = 0; $i < count($tListeFichiers); $i++) {
                            $lsOptions .= "<option value='$tListeFichiers[$i]'>$tListeFichiers[$i]</option>";
                        }
                        echo $lsOptions;
                        ?>
                    </select>
                    <br>
                    <input type="hidden" name="action" value="selectionFichierValidee" />
                    <input type="submit" value="Valider" />
                </form>
            </section>

            <section id="tables">
                <form action="../controls/CSVCTRL.php" method="get">
                    <label><strong>Liste des champs</strong></label>
                    <br>
                    <select name="listeChamps" size="5">
                        <?php
                        /*
                         * 
                         */
                        $lsOptions = "";
                        if (isSet($tListeChamps)) {
                            for ($i = 0; $i < count($tListeChamps); $i++) {
                                $lsOptions .= "<option value='$tListeChamps[$i]'>$tListeChamps[$i]</option>";
                            }
                        }
                        echo $lsOptions;
                        ?>
                    </select>
                </form>
            </section>

            <br class='nettoyeur'>

            <textarea cols="80" rows="15">
                <?php
                echo $texte;
                ?>
            </textarea>

            <p>
                <label id='lblMessage'>
                    <?php
                    if (isSet($lsMessage)) {
                        echo $lsMessage;
                    }
                    ?>
                </label>
            </p>
        </section>

        <footer id="footer">
            <?php
            include 'partials/Footer.php';
            ?>
        </footer>
        <?php ?>
    </body>
</html>
