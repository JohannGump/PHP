<!DOCTYPE html>
<!--
VillesDeleteIHM.php
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3>DELETE</h3>
        <form action="VillesDelete.php" method="post">
            <label>CP </label>
            <input type="text" name="cp" value="75021" size="5" />

            <input type="submit" name="btValider"/>
        </form>

        <br>
        
        <label>
            <?php
            if (isSet($lsMessage)) {
                echo $lsMessage;
            }
            ?>
        </label>

    </body>
</html>
