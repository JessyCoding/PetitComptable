<?php
    include_once 'utils.php';
?>
<!DOCTYPE   html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
       
    </head>
    <body>
        
        <?php
            $bankaccounts = get_userbankaccounts();
            if(!empty($bankaccounts)){
                echo '<p><h1 class="titre">Selection d\'un compte bancaire</h1></p>';
                display_bankaccounts();
            }
        ?>

        <form method="Post" action="bankaccounts.php">
            <p>
                <h1 class="titre">Création d'un compte bancaire</h1>
            </p>
            <input class="casseText" type="text" name="name" placeholder="Nom du copmte">
            <br>
            <br>

            <input type="text" name="provision" placeholder="ex : 10,00">
            <br>
            <br> 
            Type de compte :
            <select name="type" id="compte">
                <option value="Courant">Courant</option>
                <option value="Epargne">Epargne</option>
                <option value="Compte joint">Compte joint</option>
            </select>
            <br>
            <br> 
            Devise du compte :
            <select name="devise" id="Devise du compte">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
            </select>
            <br>
            <br>

            <input type="submit" name="submitCreateBA" value="ok">
        </form>
        
        <?php
            $bankaccounts = get_userbankaccounts();
            if(!empty($bankaccounts)){
                echo '<p><h1 class="titre">Suppression d\'un compte bancaire</h1></p>';
                echo "<form>";
                echo '<select name="account">';
        
                display_bankaccounts();
                    
                echo "</select>";
                echo '<input type="submit" name="submitDeleteBA" value="Supprimer">';
                echo "</form>";
                echo '<a href="form_movements.php">Entrer des operations</a>';
            }
        ?>
    </body>
</html>