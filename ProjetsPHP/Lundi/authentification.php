<?php
$pseudo = filter_input(INPUT_GET, "pseudo");
$mdp = filter_input(INPUT_GET, "mdp");
if ($pseudo == null){
    if(!isset($_GET["pseudo"])) {
            echo "c'est null";
    } else {
        echo "c'est vide";
    }
}else{
    if (empty($_GET["pseudo"])){
        echo "c'est vide";
    }
    echo $pseudo . "-" . $mdp;
}
?>

<?php
$pseudo = $_GET["pseudo"];
$mdp = $_GET["mdp"];
echo $pseudo . "-" . $mdp;
?>