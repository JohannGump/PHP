<?php

// --- Premier passage
if (!isSet($_REQUEST["verif"])) {
    $url = $_SERVER['PHP_SELF'] . "?verif=1";
    header("Location: $url");
    setcookie("cookie_verif", "1");
}



// --- Deuxième passage
if (isSet($_REQUEST["verif"])) {
    if (isSet($_COOKIE["cookie_verif"])) {
        echo "Votre navigateur prend en charge les cookies...";
    } else {
        echo "Votre navigateur <strong>ne prend pas</strong> en charge les cookies";
    }
}
?>