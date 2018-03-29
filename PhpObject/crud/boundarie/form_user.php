<?php require '../control/controller.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<pre></pre>
<div class="container">
    <form action="../control/controller.php" method="POST">
        <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" placeholder="Votre nom" name="user_name" value="<?php if(isset ($utilisateur)) echo $utilisateur->getName() ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" placeholder="Votre email" name="user_email">
        </div>
        <div class="form-group">
            <label>Téléphone</label>
            <input type="tel" class="form-control" placeholder="Votre numéro de téléphone" name="user_phone">
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="user_enabled">
            <label class="form-check-label" for="exampleCheck1">Compte activé</label>
        </div>
        <div class="form-group">
            <label>Type de compte</label>
            <select name="user_type">
                <option value="0">Normal</option>
                <option value="1">Admin</option>
            </select>
        </div>
        <div class="form-group">
            <label>Pseudo</label>
            <input type="text" class="form-control" placeholder="Pseudo de l'admin" name="user_pseudo">
        </div>

        <input type="submit" class="btn btn-primary" name="action" value="Enregistrer"/>
    </form>

    <form method="GET" style="margin-top: 45px;padding-top:15px;border-top:2px solid;">
        <div class="form-group">
            <label>Charger un utilisateur</label>
            <select name="user_to_load">
                <?php
                            foreach ($utilisateurs as $utilisateur) {
                                echo "<option value='".$utilisateur['id']."'>".$utilisateur['name']." ".$utilisateur['id']."</option>";
                }
                ?>
            </select>
        </div>

        <input type="submit" name="action" class="btn btn-primary" value="Charger"/>
        <input type="submit" name="action" class="btn btn-primary" value="Supprimer"/>
    </form>
</div>

</body>
</html>