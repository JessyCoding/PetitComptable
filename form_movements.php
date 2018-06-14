
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
        <form method="POST" action="movements.php">
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
                <?php
                    display_movements();
                ?>
                <tr>
                    <th><input type="text" name="name" placeHolder="Nom de la transaction" maxlength="35"/></br></th>
                    <th><select name="type">
                    <?php
                        display_categories();
                    ?>
                    </select></th>
                    <th><input type="number" name="amount" placeHolder="Montant"/></br></th>
                
                    <th><select name="paymentMethod">
                        <option value="Carte Bleue">Carte Bleue</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Virement">Virement</option>
                        <option value="Prelevement">Prelevement</option>
                    </select></th>
                    <th><input type="submit" name="submitCreateM" value="Valider"/></th>
                </tr>
            </table>
        </form>
        <a href="form_bankaccounts.php">Gestion des comptes</a>
    </body>
</html>