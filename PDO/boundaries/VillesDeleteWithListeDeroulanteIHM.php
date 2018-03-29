<!DOCTYPE html>
<!--
VillesDeleteIHMWithListeDeroulante.php
-->

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3>DELETE</h3>
        <form action="VillesDeleteWithListeDeroulanteCTRL.php" method="post">
            <label>CP </label>
            <select name="cp">
                <?php
                echo $lsOptions;
                ?>
            </select>

            <input type="submit" />
        </form>
        <br>

        <label>
            <?php
            echo $lsMessage;
            ?>
        </label>
    </body>
</html>
