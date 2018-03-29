<!DOCTYPE html>
<!--
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <title>Suppression client</title>
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
            <h1>Suppression client</h1>
            <form action='../controls/MainCTRL.php' method='POST'>
                <table class='formulaireTable'>
                    <tr>
                        <td>
                            <label for='id_client' class='etiquette'>Id client</label>
                        </td>
                        <td>
                            <input type='text' value='<?php echo $id_client; ?>' name='id_client' id='id_client' readonly='readonly'/>
                        </td>
                    </tr>

<!--                    <tr>
                        <td>
                            <label for='nom' class='etiquette'>Nom</label>
                        </td>
                        <td>
                            <input type='text' value='Ribouldingue' name='nom' id='nom' />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for='date_naissance' class='etiquette'>Date naissance</label>
                        </td>
                        <td>
                            <input type='text' value='1930-08-27' name='date_naissance' id='date_naissance' />
                        </td>
                    </tr>-->

                    <tr>
                        <td>
                            <input type="hidden" name="action" value="desinscriptionValidation" />
                        </td>
                        <td>
                            <button type='submit'>Supprimer</button>
                        </td>
                    </tr>
                </table>
            </form>
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
