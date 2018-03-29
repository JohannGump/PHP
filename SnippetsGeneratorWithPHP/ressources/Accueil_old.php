<?php
session_start();
?>
<!DOCTYPE html>
<!--
Accueil de PHPGenerator
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            input[type="submit"]{
                width: 150px;
            }
            select{
                width: 150px;
            }
            #divBDs, #divTables, #divColumms{
                float: left;
                margin: 3px;
            }
            #divButtonsOutputs{
                clear: both;
            }
        </style>
        <title>Accueil PHP Generator</title>
    </head>

    <body>

        <?php
        require_once '../lib/Connexion.php';
        require_once '../lib/Metabase.php';

        if (empty($_GET)) {
            $tTables = array();
            $tColumns = array();
            $_SESSION = array();
        }

        $lsTables = "";
        $lsDBs = "";
        $lsColumns = "";

        $lcnx = seConnecter("../conf/connexion.ini");

        $tDBs = getBDsFromServeur($lcnx);
        foreach ($tDBs as $value) {
            $lsDBs .= "<option value='$value'>$value</option>";
        }

        $db = filter_input(INPUT_GET, "listDBs");
        if ($db != null || isSet($_SESSION["db"])) {
            $_SESSION["db"] = $db;
            $tTables = getTablesFromBD($lcnx, $db);
            foreach ($tTables as $value) {
                $lsTables .= "<option value='$value'>$value</option>";
            }
        }

//        if (isSet($_SESSION["db"])) {
//            $db = $_SESSION["db"];
//            $tTables = getTablesFromBD($lcnx, $db);
//            foreach ($tTables as $value) {
//                $lsTables .= "<option value='$value'>$value</option>";
//            }
//        }

        $table = filter_input(INPUT_GET, "listTables");
        if ($table != null) {
            $_SESSION["table"] = $table;
            $tColumns = getColumnsNamesFromTable($lcnx, $db, $table);
            foreach ($tColumns as $value) {
                $lsColumns .= "<option value='$value'>$value</option>";
            }
        }

        if (isSet($_SESSION["table"])) {
            $table = $_SESSION["table"];
            $tTables = getTablesFromBD($lcnx, $db);
            foreach ($tTables as $value) {
                $lsTables .= "<option value='$value'>$value</option>";
            }
        }



//        $table = filter_input(INPUT_GET, "listTables");
//        if ($table != null) {
//            $_SESSION["table"] = $table;
//            $tColumns = getColumnsNamesFromTable($lcnx, $db, $table);
//            foreach ($tColumns as $value) {
//                $lsColumns .= "<option value='$value'>$value</option>";
//            }
//        }


        /*
         * FORM
         */
        $btForm = filter_input(INPUT_GET, "btForm");
        if ($btForm != null) {
            $sql = "SELECT * FROM $db" . "." . $table;
            echo "<br>$sql<br>";
            $lrs = $lcnx->query($sql);
            $tData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            $form = "<form>\n";
            foreach ($tData as $value) {
                $form .= "<label>$value</label><br>\n";
                //$form .= "<input type='text' id='$key' name='$key' /><br>\n";
            }
            $form .= "</form>\n";
            echo htmlentities("<br>$form<br>");
            file_put_contents($table . ".html", $form);
        }


        /*
         * TABLE
         */
        $btTable = filter_input(INPUT_GET, "btTable");

        /*
         * JSON
         */
        $btJSON = filter_input(INPUT_GET, "btJSON");
        if ($btJSON != null) {
            $sql = "SELECT * FROM $db" . "." . $table;
            echo "<br>$sql<br>";
            $lrs = $lcnx->query($sql);
            $tData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            $str = json_encode($tData);
            file_put_contents($table . ".json", $str);
        }

        /*
         * CSV
         */
        $btCSV = filter_input(INPUT_GET, "btCSV");
        /*
         * XML
         */
        $btXMLData = filter_input(INPUT_GET, "btXMLData");

        seDeconnecter($lcnx);
        ?>

        <div id="divBDs">
            <form action="" method="GET">
                <p>
                    <label>BD ?</label>
                </p>
                <p>
                    <select name="listDBs" size="5">
                        <?php
                        echo $lsDBs;
                        ?>
                    </select>
                </p>
                <p>
                    <input type="submit" value="Valider BD" name="btValiderBds" />
                </p>
            </form>
        </div>

        <div id="divTables">
            <form action="" method="GET">
                <p>
                    <label>Table ?</label>
                </p>
                <p>
                    <select name="listTables" size="5">
                        <?php
                        echo $lsTables;
                        ?>
                    </select>
                </p>
                <p>
                    <input type="submit" value="Valider Tables" name="btValiderTables" />
                </p>
            </form>
        </div>

        <div id="divColumns">
            <form action="" method="GET">
                <p>
                    <label>Colonne(s) ?</label>
                </p>
                <p>
                    <select name="listColumns" size="5">
                        <option value="*">Toutes</option>
                        <?php
                        echo $lsColumns;
                        ?>
                    </select>
                </p>
                <p>
                    <input type="submit" value="Valider Columns" name="btValiderColumns" />
                </p>
            </form>
        </div>

        <div id="divButtonsOutputs">
            <form action="" method="GET">
                <input type="submit" value="Formulaire" name="btForm" />
                <input type="submit" value="Table" name="btTable" />
                <input type="submit" value="JSON" name="btJSON" />
                <input type="submit" value="CSV" name="btCSV" />
                <input type="submit" value="XML Data" name="btXMLData" />
            </form>
        </div>

    </body>
</html>
