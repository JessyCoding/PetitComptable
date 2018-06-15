<?php
    include_once 'utils.php';
?>
<!DOCTYPE   html>
<html>
    <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <title>PC - Petit con...</title>
    <link rel="icon" href="logo.png">
       
    </head>
    <body>
    <header> 
            <div id="header"><p class="textNamePres">Bonjour <span><?php echo $_SESSION["pseudo"]; ?></span> !</p></div>
    </header>
        <section id="infoSection" class="flexTag">
        
            
            <div class="form flexTag center">
                <table id="myTable">
                    <tr>
                        <th></th>
                        <th><p class="textNamePres"><span class="spanWhiteShadow">Name</span></p></th>
                        <th><p class="textNamePres"><span class="spanWhiteShadow">Type</span></p></th>
                        <th><p class="textNamePres"><span class="spanWhiteShadow">Amount</span></p></th>
                        <th><p class="textNamePres"><span class="spanWhiteShadow">Devise</span></p></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                        display_bankaccounts();
                    ?>
                    <form method="POST" action="bankaccounts.php">
                        <tr>
                            <th></th>
                            <th><input class="casseText" type="text" name="name" placeholder="Nom du copmte"></th>
                            <th><select name="type">
                                <?php
                                    display_types();
                                ?>
                            </select></th>
                            <th><input type="number" step="0.01" name="amount" placeholder="ex : 10"></th>
                            <th><select name="devise" id="Devise du compte">
                                <?php
                                    display_devises();
                                ?>
                            </select></th>
                            <th><input type="submit" name="submitCreateBA" value="Valider"/></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </form>
                </table>
            </div>
            <div class="logo"><img src="logo.png"/><p class="textNamePres"><span class="spanWhiteShadow">Voici la liste de vos comptes</span></p></div>
        </section>
    </body>
</html>