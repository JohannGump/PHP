<?php

/*

 */

/**
 * 
 * @param type $cp
 * @return int
 */
function controleCPSansER($cp) {
    $ok = 0;
    $longueur = strlen($cp);
    echo "$longueur<br>";
    if ($longueur == 5) {
        if (is_numeric($cp)) {
            echo "<br>" . is_int($cp);
            $ok = 1;
        } else {
            echo "<br>is_int : " . is_int($cp);
            $ok = 0;
        }
    } else {
        $ok = 0;
    }
    return $ok;
}

/**
 * 
 * @param type $cp
 * @return type
 */
function controleCPAvecER($cp) {

    $motif = "/^0[1-9][0-9]{3}$|^[^0][0-9]{4}$/";

    $ok = preg_match($motif, $cp);
    return $ok;
}

$cp = "75011";

//echo controleCPSansER($cp);
echo controleCPAvecER($cp);
?>
