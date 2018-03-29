<?php

/*
*/

$cp = "750111";
$motif = "/^0[1-9][0-9]{3}$|^[^0][0-9]{4}$/";

echo "<hr>$cp<hr>";

echo "<hr>Avec ER<br>";
$debut = microtime(true);
for ($i = 1; $i <= 1000; $i++) {
    $ok = preg_match($motif, $cp);
}
$fin = microtime(true);

$duree = $fin - $debut;

echo $debut . "<br>";
echo $fin . "<br>";
echo "Durée : " . $duree;
echo "<br>OK ? $ok";



echo "<hr>Sans ER<br>";
$debut = microtime(true);

for ($i = 1; $i <= 1000; $i++) {
    $longueur = strlen($cp);
    if ($longueur == 5) {
        if (is_numeric($cp)) {
            $ok = 1;
        } else {
            $ok = 0;
        }
    } else {
        $ok = 0;
    }
}

$fin = microtime(true);

$duree = $fin - $debut;

echo $debut . "<br>";
echo $fin . "<br>";
echo "Durée : " . $duree;
echo "<br>OK ? $ok";
?>

