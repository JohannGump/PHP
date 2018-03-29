<?php
print("Le IF <br>");
$age = 18;
if ($age == 18) {
    print ("Vient juste d'atteindre sa majorité<br>");
}
if ($age >= 18) {
    print ("Majeur<br>");
}
else {
    print ("Mineur<br>");
}

print("Le IF ... ELSEIF<br>");
$temperature = 1000;
if ($temperature <= 0) {
    print ("Solide<br>");
}
elseif (($temperature > 0) and ($temperature < 100) ) {
    print ("Liquide<br>");
}
else {
    print ("Gazeux<br>");
}
?>

