<?php
    include_once 'utils.php';
?>
<!DOCTYPE   html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
       
    </head>
    <body><h1 class="titre">Bonjour <span><?php echo $_SESSION["pseudo"]; ?></span> !</h1>
        <h3>Voici la liste de vos comptes !</h1>
        <table>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Devise</th>
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
                    <th><input type="number" name="amount" placeholder="ex : 10"></th>
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
    </body>
</html>