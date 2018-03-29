<?php

require 'candidature.php';

if (isset($_POST['enregistrer'])) {
    $civilite = $_POST["civilite"];
    $nom = $_POST["nom"];
    $dateNaissance = $_POST["date_naissance"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $cp = $_POST["code_postal"];
    $cv = $_POST["cv"];

    $candidature = new Candidature($cv, $nom, $dateNaissance, $email);

    var_dump($candidature);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <form action="" method="POST">
        <div class="form-group">
            <label>Civilité</label>
                <br><input class="form-check-input" type="radio" name="civilite" value="homme" checked> Homme<br>
                <input class="form-check-input" type="radio" name="civilite" value="femme"> Femme<br>
                <input class="form-check-input" type="radio" name="civilite" value="autre"> Autre
        </div>
        <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" placeholder="Votre nom" name="nom" required pattern="[A-Za-z]{3,10}">
        </div>
        <div class="form-group">
            <label>Date de naissance</label>
            <input type="text" class="form-control" placeholder="Votre date de naissance" name="date_naissance" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Votre email" name="email" required>
        </div>
        <div class="form-group">
            <label>Téléphone</label>
            <input type="tel" class="form-control" placeholder="Votre numéro de téléphone" name="telephone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
        </div>
        <div class="form-group">
            <label>Code postal</label>
            <input type="text" class="form-control" placeholder="Votre code postal" name="code_postal"  pattern="[0-9]{5}">
        </div>
        <div class="form-group">
            <label>CV</label>
            <input type="file" class="form-control-file" placeholder="Votre CV" name="cv" required accept="application/pdf">
        </div>
        <input type="submit" class="btn btn-primary" name="enregistrer" value="Enregistrer"/>
    </form>
</div>

</body>
</html>