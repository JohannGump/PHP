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
        
        <section id="centre">
            <br>
            <form action="../controls/MainControl.php" method="GET">
            <select name="listeVilles">
                <?php
                $lsContenu = "";
                foreach ($tVilles as $cle => $valeur) {
                    // Instructions
                   $lsContenu .= "<option value='"  . $cle . " '>" . $valeur . "</option>\n";
                }
                
                //    for ($i =0; $i <count($tVilles); $i++) {
                //        //$lsContenu .= "<option value='" . $tVilles[$i] . "'>" . $tVilles[$i] . "</option>\n";
                //        $lsContenu .= "<option value=''></option>";
                //        ////$lsContenu .= "<option value='$tVilles[$i]'>$tVilles[$i]</option>\n";
                //    }
                    
                               
                echo $lsContenu;
                ?>
            </select>
                <input type="submit" />
                <input type="hidden" name="action" value="deleteValidation" />
            </form>           
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
