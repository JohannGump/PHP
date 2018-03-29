<?php
session_start();
?>
<!DOCTYPE html>
<!--
Accueil de PHPGenerator
TODO : XML with API XML ou API JDOM
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/PHPGenerator.css">
        <title>Accueil PHP Generator</title>
    </head>

    <body>

        <?php
        require_once '../lib/Connexion.php';
        require_once '../lib/Metabase.php';
        require_once '../lib/Array2Strings.php';

        $lsMessage = "";

        if (empty($_GET)) {
            $arrayTables = array();
            $arrayColumns = array();
            $_SESSION = array();
        }

        $lsDBName = "";
        $lsTablesNames = "";
        $lsColumnsNames = "";

        $lsDBsOptions = "";
        $lsTablesOptions = "";
        $lsColumnsOptions = "";

        $lcnx = seConnecter("../conf/connexion.ini");

        /*
         * LIST OF DB
         */
        $arrayDBs = getBDsFromServeur($lcnx);
        foreach ($arrayDBs as $value) {
            $lsDBsOptions .= "<option value='$value'>$value</option>\n";
        }

        /*
         * IF DB BUTTON VALIDATE
         */
        $lsDBName = filter_input(INPUT_GET, "listDBs");
        if ($lsDBName != null) {
            $_SESSION["db"] = $lsDBName;
            $arrayTables = getTablesFromBD($lcnx, $lsDBName);
            foreach ($arrayTables as $value) {
                $lsTablesOptions .= "<option value='$value'>$value</option>\n";
            }
        }

//        if (isSet($_SESSION["db"])) {
//            $db = $_SESSION["db"];
//            $arrayTables = getTablesFromBD($lcnx, $db);
//            foreach ($arrayTables as $value) {
//                $lsTables .= "<option value='$value'>$value</option>";
//            }
//        }

        /*
         * LIST OF TABLES OF A DB
         */
        $lsTableName = filter_input(INPUT_GET, "listTables");
        /*
         * IF TABLE BUTTON VALIDATE
         */
        if ($lsTableName != null) {
            $lsDBName = $_SESSION["db"];
            $_SESSION["table"] = $lsTableName;
            $lsTablesNames = $lsTableName;
            $arrayColumns = getColumnsNamesFromTable($lcnx, $lsDBName, $lsTableName);
            foreach ($arrayColumns as $value) {
                $lsColumnsOptions .= "<option value='$value'>$value</option>\n";
            }
            $arrayTables = getTablesFromBD($lcnx, $lsDBName);
            foreach ($arrayTables as $value) {
                $lsTablesOptions .= "<option value='$value'>$value</option>\n";
            }
        }

        /*
         * FORM
         */
        $btForm = filter_input(INPUT_GET, "btForm");
        if ($btForm != null) {
            $arrayData = getColumnsNamesFromTable($lcnx, $_SESSION["db"], $_SESSION["table"]);
            $form = array2Form($arrayData);
            $lsMessage = htmlentities($form);
            file_put_contents($_SESSION["table"] . ".html", $form);
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
            $sql = "SELECT * FROM " . $_SESSION["db"] . "." . $_SESSION["table"];
//            $lsMessage = "<br>$sql<br>";
            $lrs = $lcnx->query($sql);
            $arrayData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            $str = json_encode($arrayData);
            file_put_contents($_SESSION["table"] . ".json", $str);
        }

        /*
         * CSV
         */
        $btCSV = filter_input(INPUT_GET, "btCSV");
        if ($btCSV != null) {
            $sql = "SELECT * FROM " . $_SESSION["db"] . "." . $_SESSION["table"];
//            $lsMessage = "<br>$sql<br>";
            $lrs = $lcnx->query($sql);
            $arrayData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            /*
             * ARRAY 2 CSV
             */
            $csv = array2CSV($arrayData);
            $lsMessage = $csv;
            file_put_contents($_SESSION["table"] . ".csv", $csv);
        }
        /*
         * XML DATA
         */
        $btXMLData = filter_input(INPUT_GET, "btXMLData");
        if ($btXMLData != null) {
            $sql = "SELECT * FROM " . $_SESSION["db"] . "." . $_SESSION["table"];
//            $lsMessage = "<br>$sql<br>";
            $lrs = $lcnx->query($sql);
            $arrayData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            /*
             * ARRAY 2 XML DATA
             */
            $xmlData = array2XMLData($arrayData);
            $lsMessage = $xmlData;
            file_put_contents($_SESSION["table"] . "_data.xml", $xmlData);
        }
        
        /*
         * XML DOC
         */
        $btXMLDoc = filter_input(INPUT_GET, "btXMLDoc");
        if ($btXMLDoc != null) {
            $sql = "SELECT * FROM " . $_SESSION["db"] . "." . $_SESSION["table"];
//            $lsMessage = "<br>$sql<br>";
            $lrs = $lcnx->query($sql);
            $arrayData = $lrs->fetchAll(PDO::FETCH_ASSOC);
            /*
             * ARRAY 2 XML DATA
             */
            $xmlDoc = array2XMLDoc($arrayData);
            $lsMessage = $xmlDoc;
            file_put_contents($_SESSION["table"] . "_doc.xml", $xmlDoc);
        }

        seDeconnecter($lcnx);
        ?>

        <form action="" method="GET">
            <div id="divDBs">
                <p>
                    <label>BD ?</label>
                </p>
                <p>
                    <select name="listDBs" size="5" id="listDBs">
                        <?php
                        echo $lsDBsOptions;
                        ?>
                    </select>
                </p>
            </div>
            <div id="divTables">
                <p>
                    <label>Table ?</label>
                </p>
                <p>
                    <select name="listTables" size="5" multiple="multiple">
                        <?php
                        echo $lsTablesOptions;
                        ?>
                    </select>
                </p>
            </div>
            <div id="divColumns">
                <p>
                    <label>Colonne(s) ?</label>
                </p>
                <p>
                    <select name="listColumns" size="5" multiple="multiple">
                        <option value="*">Toutes</option>
                        <?php
                        echo $lsColumnsOptions;
                        ?>
                    </select>
                </p>
            </div>
            <div id="divSubmitButtons">
                <input type="submit" value="Valider BD" name="btValiderBds" />
                <input type="submit" value="Valider Tables" name="btValiderTables" />
                <input type="submit" value="Valider Columns" name="btValiderColumns" />
            </div>
            <hr>
            <input type="text" name="dbName" value="<?php echo $lsDBName; ?>"/>
            <input type="text" name="tablesNames" value="<?php echo $lsTableName; ?>"/>
            <input type="text" name="columnsNames" value="<?php echo $lsColumnsNames; ?>"/>
            <hr>
        </form>
    </div>

    <div id="divOutputsButtons">
        <form action="" method="GET">
            <input type="submit" value="Formulaire" name="btForm" />
            <input type="submit" value="Table" name="btTable" />
            <input type="submit" value="JSON" name="btJSON" />
            <input type="submit" value="CSV" name="btCSV" />
            <input type="submit" value="XML Data" name="btXMLData" />
            <input type="submit" value="XML Doc" name="btXMLDoc" />
        </form>
    </div>

    <p>
        <label>
            <?php echo $lsMessage; ?>
        </label>
    </p>

</body>
</html>
