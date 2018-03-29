<!DOCTYPE html>
<!--
ClientsAuthentificationIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <title>Authentification</title>
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
            <h1>Authentification</h1>
            <form action='../controls/MainCTRL.php' method='POST'>
                <table class='formulaireTable'>
                    <tr>
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
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="action" value="authentificationValidation" />
                        </td>
                        <td>
                            <button type='submit'>Valider</button>
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
