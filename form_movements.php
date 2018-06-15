
<?php
    include_once 'utils.php';

    if(isset($_GET['id'])) {
        $_SESSION['account'] = $_GET['id'];
    }
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
                <div id="header"><p class="textNamePres">
                    <?php
                        $ba = get_bankaccount();
                        echo '<span>'.$ba['name'].'</span>';
                    ?>
                </p></div>
        </header>
        <section id="infoSection" class="flexTag">
            <div class="form">
                <div class="flexTag">
                    <table>
                        <tr>
                            <th></th>
                            <th><p class="textNamePres"><span class="spanWhiteShadow">Name</span></p></th>
                            <th></th>
                            <th><p class="textNamePres"><span class="spanWhiteShadow">Category</span></p></th>
                            <th></th>
                            <th><p class="textNamePres"><span class="spanWhiteShadow">Amount</span></p></th>
                            <th><p class="textNamePres"><span class="spanWhiteShadow">Method</span></p></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <form method="POST" action="movements.php">
                            <tr>
                                <th></th>
                                <th><input type="text" name="name" placeHolder="Nom de la transaction" maxlength="35"/></br></th>
                                <th></th>
                                <th><select name="category">
                                    <?php
                                        display_categories();
                                    ?>
                                </select></th>
                                <th></th>
                                <th><input type="number" step="0.01" name="amount" placeHolder="Montant"/></br></th>
                            
                                <th><select name="paymentMethod">
                                    <?php
                                        display_paymentMethods();
                                    ?>
                                </select></th>
                                <th><input type="submit" name="submitCreateM" value="Valider"/></th>
                            </tr>
                        </form>
                        <?php
                            display_movements();
                        ?>
                    </table>
                </div>
            </div>
            <div class="logo"><img src="logo.png"/><p class="textNamePres"><span class="spanWhiteShadow">Voici la liste des opérations de ce compte</span></p><div class="form formDark"><p>
                    <?php
                        $ba = get_bankaccount();
                        echo '<div class="flexTag center"><div class="prop">Type : </div><div class="prop right">'.$ba['type'].'</div></div>';
                        echo '<div class="flexTag center"><div class="prop">Devise : </div><div class="prop right">'.$ba['devise'].'</div></div>';
                        echo '<div class="flexTag center"><div class="prop">Solde : </div><div class="prop right">'.$ba['amount'].'</div></div>';
                    ?>
            <div></p></div>
        </section>
    </body>
</html>