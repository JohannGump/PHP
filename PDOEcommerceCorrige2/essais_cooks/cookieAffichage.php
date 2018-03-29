<?php

header("Content-Type: text/html;charset=UTF-8");
if (array_key_exists("ut", $_COOKIE)) {
    echo "Cookie <strong>Nom d'utilisateur</strong> : " . $_COOKIE["ut"];
} else {
    echo "Cookie <strong>Utilisateur inexistant </strong>";
}

echo "<hr>";
//$nom = filter_has_var(INPUT_COOKIE, nom);
$ut = filter_input(INPUT_COOKIE, "ut");
if ($ut != null) {
    echo "Cookie <strong>Nom d'utilisateur</strong> : " . $ut;
} else {
    echo "Cookie <strong>Utilisateur inexistant </strong>";
}
?>