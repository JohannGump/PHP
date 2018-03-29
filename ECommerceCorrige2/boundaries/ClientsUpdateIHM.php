<!DOCTYPE html>
<!--
ClientsUpdateIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <title>Changement client</title>
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
            <h1>Changement client</h1>
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
                    <tr>
                        <td>
                            <label for='nom' class='etiquette'>Nom</label>
                        </td>
                        <td>
                            <input type='text' value='<?php echo $nom; ?>' name='nom' id='nom' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for='prenom' class='etiquette'>Prenom</label>
                        </td>
                        <td>
                            <input type='text' value='<?php echo $prenom; ?>' name='prenom' id='prenom' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for='date_naissance' class='etiquette'>Date naissance</label>
                        </td>
                        <td>
                            <input type='text' value='<?php echo $date_naissance; ?>' name='date_naissance' id='date_naissance' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for='adresse' class='etiquette'>Adresse</label>
                        </td>
                        <td>
                            <input type='text' value='<?php echo $adresse; ?>' name='adresse' id='adresse' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for='cp' class='etiquette'>Cp</label>
                        </td>
                        <td>
                            <select name='cp' id='cp'>
                                <?php
                                for ($i = 0; $i < count($tVilles); $i++) {
                                    if ($tVilles[$i][0] == $cp) {
                                        echo "<option value='" . $tVilles[$i][0] . "' selected='selected'>" . $tVilles[$i][1] . "</option>\n";
                                    } else {
                                        echo "<option value='" . $tVilles[$i][0] . "'>" . $tVilles[$i][1] . "</option>\n";
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="action" value="changementClientValidation" />
                        </td>
                        <td>
                            <button type='submit'>Modifier</button>
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
