
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
       
    </head>
    <body>
        <p>
            <?php
                $ba = get_bankaccount();
                echo '<h1>'.$ba['name'].' :</h1>';
                echo '<div>Type :    '.$ba['type'].'</div>';
                echo '<div>Devise :  '.$ba['devise'].'</div>';
                echo '<div>Solde :   '.$ba['amount'].'</div>';
            ?>
        </p>
        <table>
            <tr>
                <th></th>
                <th>Name</th>
                <th></th>
                <th>Category</th>
                <th></th>
                <th>Amount</th>
                <th>Method</th>
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
                    <th><input type="number" name="amount" placeHolder="Montant"/></br></th>
                
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
    
        <a href="form_bankaccounts.php">Gestion des comptes</a>
    </body>
</html>