<?php

function db_connect_movements(){
    try{
        $host = "localhost";
        $dbname = "petitcomptable";
        $user = "root";
        $password = "root";

        $db = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $user,
            $password
        );
        return $db;
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }

}

if (isset($_POST['submitCreate'])) {
    $db = db_connect_movements();

    $account = $_POST['account'];

    $reqBA = $db->prepare("INSERT INTO bankAccounts (`id`,`name`, `type`, `amount`, `devise`, `idUser`) VALUES (:id,'Test', 'Courant', '5000', 'EUR', '1')");
    $reqBA->execute(array("id"=>$account));

    $reqBA->closeCursor();

    $reqMs = $db->prepare("INSERT INTO movements (`idBankAccount`, `name`,`idCategory`, `amount`, `paymentMethod`) VALUES (:account, 'testCredit', '8', '50', 'Cheque'),(:account, 'testCredit', '2', '50', 'Cheque')");
    $reqMs->execute(array("account"=>$account));

    $reqMs->closeCursor();
}

if (isset($_POST['submitDelete'])){

    $db = db_connect_movements();
    $account = $_POST['account'];
    //delete 
    $reqDelMvts= $db->prepare("DELETE FROM movements  WHERE idBankAccount = ?");
    $reqDelMvts->execute(array($account));

    $reqDelMvts->closeCursor();

    $reqDelBA= $db->prepare("DELETE FROM bankAccounts  WHERE id = ?");
    $reqDelBA->execute(array($account));

    $reqDelBA->closeCursor();

}


header('Location: movements.php');

?>