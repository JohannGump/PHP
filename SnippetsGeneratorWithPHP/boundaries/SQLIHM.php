<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <title>SQLIHM</title>
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
            <h1>SQL IHM</h1>

            <section id="bds">
                <form action="../controls/SQLCTRL.php" method="get">
                    <label><strong>Liste des BDs</strong></label>
                    <br>
                    <select name="listeBDs" size="5">
                        <?php
                        /*
                         * 
                         */
                        $lsOptions = "";
                        for ($i = 0; $i < count($tListeBDs); $i++) {
                            $lsOptions .= "<option value='$tListeBDs[$i]'>$tListeBDs[$i]</option>";
                        }
                        echo $lsOptions;
                        ?>
                    </select>
                    <br>
                    <input type="hidden" name="action" value="selectionBDValidee" />
                    <input type="submit" value="Valider" />
                </form>
            </section>

            <section id="tables">
                <form action="../controls/SQLCTRL.php" method="get">
                    <label><strong>Liste des tables</strong></label>
                    <br>
                    <select name="listeTables" size="5">
                        <?php
                        /*
                         * 
                         */
                        $lsOptions = "";
                        if (isSet($tListeTables)) {
                            for ($i = 0; $i < count($tListeTables); $i++) {
                                $lsOptions .= "<option value='$tListeTables[$i]'>$tListeTables[$i]</option>";
                            }
                        }
                        echo $lsOptions;
                        ?>
                    </select>
                    <br>
                    <input type="hidden" name="action" value="selectionTableValidee" />
                    <input type="submit" value="Valider" />
                </form>
            </section>

            <section id="colonnes">
                <label><strong>Liste des colonnes</strong></label>
                <br>
                <select name="listeColonnes" size="5">
                    <?php
                    /*
                     * 
                     */
                    $lsOptions = "";
                    if (isSet($tListeColonnes)) {
                        for ($i = 0; $i < count($tListeColonnes); $i++) {
                            $lsOptions .= "<option value='$tListeColonnes[$i]'>$tListeColonnes[$i]</option>";
                        }
                    }
                    echo $lsOptions;
                    ?>
                </select>
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
