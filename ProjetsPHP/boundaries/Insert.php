<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
        <header id="header">
            <?php
            include '../boundaries/partials/header.php';
            ?>
        </header>
        
        <nav id="nav">
            <?php
            include '../boundaries/partials/nav.php';
            ?>           
        </nav>
        
        <section id="section">
            <form action="../controls/MainControl.php" method="GET">
                <label>CP</label>
                <br>
                <input type="text" name="cp" value ="59000" />
                <br>
                <label>Nom de la ville</label>
                <br>
                <input type="text" name="nomVille" value ="Lille" />
                <br>
                Date de naissance :
                <select name="jours">
                    <?php
                    $lsOption = "";
                    for ($i = 1; $i < 32; $i++) {
                      $lsOption .= "<option value='$i'>$i</option>";              
                    }
                    echo $lsOption;
                    ?>
                </select>
                <select name="mois">
                   <?php
                    $lsOption = "";
                    for ($i = 0; $i < count($tMois); $i++) {
                      $lsOption .= "<option value='". ($i+ 1) . "'>$tMois[$i]</option>\n";  
                    }
                    echo $lsOption;
                    ?>                    
                </select>
                <select name="annees">
                   <?php
                   $d = getdate();
                   $annee =$d["year"];
                    $lsOption = "";
                    for ($i = 1900; $i < $annee; $i++) {
                      $lsOption .= "<option value='$i'>$i</option>";              
                    }
                    echo $lsOption;
                   ?>   
                </select>
                <input type="submit" value ="Valider" />
                <input type="hidden" name="action" value="insertValidation" />
                   
                             
            </form>
            
            <p>
            <?php
            if(isset($lsMessage)){
                echo $lsMessage;
            }
            ?>   
            </p>
        </section>
        
        <footer id="footer">
            <?php
            include '../boundaries/partials/footer.php';
            ?>                
        </footer>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
