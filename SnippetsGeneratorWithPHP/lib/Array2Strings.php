<?php

/*
  Array2Strings.php
 */

/**
 * 
 * @param type $arrayTable
 * @return string
 */
function array2JSON($arrayTable) {
    /*
     * Product a JSON String from an ordinal array of hash table of columns names and data
     */
    $s = "";
    $s = json_encode($arrayTable);
    return $s;
}

/**
 * 
 * @param type $arrayTable
 * @return string
 */
function array2XMLData($arrayTable) {
    /*
     * Product a XML String (data are in attributes tag) from an ordinal array of hash table of columns names and data
     */
    $s = "";
    // Prologue
    $s .= "<?xml version = '1.0' encoding='UTF-8' standalone='yes' ?>\n";
    $s .= "<root>\n";

    for ($i = 0; $i < count($arrayTable); $i++) {
        $s .= "<record ";
        $record = $arrayTable[$i];
        foreach ($record as $key => $value) {
            $s .= "$key='$value' ";
        }
        $s .= "/>";
        $s .= "\n";
    }

    $s .= "</root>\n";
    return $s;
}

/**
 * 
 * @param type $arrayTable
 * @return string
 */
function array2XMLDoc($arrayTable) {
    /*
     * Product a XML String (data are in text nodes) from an ordinal array of hash table of columns names and data
     */
    $s = "";
    // Prologue
    $s .= "<?xml version = '1.0' encoding='UTF-8' standalone='yes' ?>\n";
    $s .= "<root>\n";

    for ($i = 0; $i < count($arrayTable); $i++) {
        $s .= "<record>\n";
        $record = $arrayTable[$i];
        foreach ($record as $key => $value) {
            $s .= "<$key>\n$value\n</$key>\n";
        }
        $s .= "</record>\n";
    }

    $s .= "</root>\n";
    return $s;
}

/**
 * 
 * @param type $arrayTable
 * @return string
 */
function array2CSV($arrayTable) {
    /*
     * Product a CSV String (headers and data) from an ordinal array of hash table of columns names and data
     */
    $s = "";

    echo "<br><pre>";
    var_dump($arrayTable);
    echo "</pre><br>";

    /*
     * HEADERS OF CSV
     */
    $arrayLine1 = $arrayTable[0];
    foreach ($arrayLine1 as $key => $value) {
        $s .= "$key;";
    }
    $s = substr($s, 0, -1);
    $s .= "\n";
    /*
     * VALUES
     */
    for ($i = 0; $i < count($arrayTable); $i++) {
        $record = $arrayTable[$i];
        foreach ($record as $value) {
            $s .= "$value;";
        }
        $s = substr($s, 0, -1);
        $s .= "\n";
    }

    return $s;
}

/**
 * 
 * @param type $arrayTable
 * @return string
 */
function array2Form($arrayTable) {

    /*
     * Product a <form> from an ordinal array of columns names
     */
//    echo "<br><pre>";
//    var_dump($arrayTable);
//    echo "</pre><br>";

    $s = "";
    $s = "<form>\n";
    foreach ($arrayTable as $column) {
        $s .= "<p>\n";
        $s .= "<label>$column</label>\n";
        $s .= "</p>\n";
        $s .= "<p>\n";
        $s .= "<input type='text' name='$column' id='$column' />\n";
        $s .= "</p>\n";
    }
    $s .= "</form>\n";
    return $s;
}

/**
 * 
 * @param type $arrayTable
 * @return string
 */
function array2HTMLTable($arrayTable) {
    $s = "";

    return $s;
}

?>
