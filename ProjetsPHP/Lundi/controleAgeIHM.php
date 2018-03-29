<!DOCTYPE html>
<!--
contreAgeIHM.php
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="controleAge.php" method="GET">
            <label>age</label>
            <input type="text" name="age">
             <input type="submit" />
        </form>
        <?php
        if(isset($lsmessage)){
           echo $lsmessage;
        }
        ?>
    </body>
</html>
