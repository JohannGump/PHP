<?php

//session_start();

$lsMessage = "";

require_once '../lib/Connexion.php';

require_once '../lib/VARDUMP.php';

$pdo = seConnecter("../conf/cours.ini");

/**
 * 
 * @param type $pdo
 * @param type $db
 * @param type $table
 * @param type $file
 */
function chooseDBTable($pdo, $db, $table, $file) {

    /** CALL OF ALL NEEDED FONCTIONS * */
    // retrieve attribute from table
    function getColumnsNamesFromTable(PDO $pcnx, $psBD, $psTable) {
        $lsSelect = "SELECT COLUMN_NAME FROM information_schema.columns WHERE TABLE_SCHEMA='$psBD' AND TABLE_NAME='$psTable'";
        return getTableau1DFromSelect($pcnx, $lsSelect);
    }

    // function to delete underscore and writing in camelCase style
    function dashesToCamelCase($string, $capitalizeFirstCharacter = false) {

        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * 
     * @param type $pcnx
     * @param type $psSelect
     * @return array
     */
    function getTableau1DFromSelect($pcnx, $psSelect) {
        $t1D = array();
        $lrs = null;
        try {
            $lrs = $pcnx->prepare($psSelect);
            $lrs->execute();
            $lrs->setFetchMode(PDO::FETCH_NUM);
            foreach ($lrs as $enr) {
                array_push($t1D, $enr[0]);
            }
            $lrs->closeCursor();
        } catch (PDOException $e) {
            $lrs = null;
            array_push($t1D, $e->getMessage());
        }
        return $t1D;
    }

    echo dashesToCamelCase('id_pays');


    $myfile = fopen(ucfirst($table) . "DTO.php", "w") or die("Unable to open file!");


    $t = getColumnsNamesFromTable($pdo, $db, $table);

    $attributeConstructor = "";
    $parameters = "";
    $setter = "";
    $getter = "";
    $numItems = count($t);
    $i = 0;

    if ($file == "php") {

        $myfile = fopen(ucfirst($table) . "DTO.php", "w") or die("Unable to open file!");
        fwrite($myfile, "<?php \n");

        $texte = "class " . ucfirst($table) . " {\n";
        fwrite($myfile, $texte);

        foreach ($t as $attribute) {

            $texte = "      private \$" . $attribute . "; \n";
            fwrite($myfile, $texte);

            if (++$i === $numItems) {
                $parameters .= "\$" . $attribute . " = \"\"";
            } else {
                $parameters .= "\$" . $attribute . " = \"\", ";
            }

            // attribute constructor
            $attributeConstructor .= "      \$this->" . $attribute . " = $" . $attribute . ";\n";

            $setter .= "  function set" . dashesToCamelCase($attribute, true) . "(\$" . $attribute . "){\n      \$this->" .
                    $attribute . " = $" . $attribute . ";\n  } \n \n";

            $getter .= "  function get" . dashesToCamelCase($attribute, true) . "(){\n      return \$this->" .
                    $attribute . ";\n  } \n \n";
        }

        fwrite($myfile, "\n");

// constructor
        $texte = "  function __construct (" . $parameters . ") {\n";

        fwrite($myfile, $texte);
        fwrite($myfile, $attributeConstructor);
        fwrite($myfile, "  }\n");
        fwrite($myfile, "\n");


//setter
        fwrite($myfile, $setter);

//getter
        fwrite($myfile, $getter);

        fwrite($myfile, "}\n");

        fwrite($myfile, "\n ?>");
    } elseif ($file == "html") {

        $myfile = fopen(ucfirst($table) . "DTO.html", "w") or die("Unable to open file!");
        $pattern = "<!DOCTYPE html>\n" .
                "    <html>\n" .
                "        <head>\n" .
                "            <title>TODO supply a title</title>\n" .
                "            <meta charset=\"UTF-8\">\n " .
                "            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n" .
                "        </head>\n" .
                "<body>\n";
        fwrite($myfile, $pattern);

        $texte = "<p>class " . ucfirst($table) . " {</p>\n";

        fwrite($myfile, $texte);

        foreach ($t as $attribute) {

            $texte = "<p style=\"margin-left:20px;\">private \$" . $attribute . "; </p>\n";
            fwrite($myfile, $texte);

            if (++$i === $numItems) {
                $parameters .= "\$" . $attribute . " = \"\"";
            } else {
                $parameters .= "\$" . $attribute . " = \"\", ";
            }

            // attribute constructor
            $attributeConstructor .= "<p style=\"margin-left:20px;\">\$this->" . $attribute . " = $" . $attribute . ";</p>\n";

            $setter .= "<p>function set" . dashesToCamelCase($attribute, true) . "(\$" . $attribute . "){</p>\n" .
                    "<p style=\"margin-left:20px;\">\$this->" . $attribute . " = $" . $attribute . ";\n  }</p> \n \n";

            $getter .= "<p>function get" . dashesToCamelCase($attribute, true) . "(){</p>\n" .
                    "<p style=\"margin-left:20px;\"> return \$this->" . $attribute . ";\n  } </p> \n \n";
        }

        fwrite($myfile, "\n");

// constructor
        $texte = "<p>function __construct (" . $parameters . ") {</p>\n";

        fwrite($myfile, $texte);
        fwrite($myfile, $attributeConstructor);
        fwrite($myfile, "<p style=\"margin-left:20px;\">}\n</p>");
        fwrite($myfile, "\n");


//setter
        fwrite($myfile, $setter);

//getter
        fwrite($myfile, $getter);

        fwrite($myfile, "<p>}</p>\n");

        fwrite($myfile, "</body>\n</html>");
    } else {
        echo("error choose php or html");
    }


    fclose($myfile);
}

chooseDBTable($pdo, "cours", "clients", "php");
?>