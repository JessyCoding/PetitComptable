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

if (isset($_POST['submitForm'])) {
    $db = db_connect_movements();

    $account = $_POST['account'];
    $name = $_POST['name'];
    $category = $_POST['type'];
    $method = $_POST['paymentMethod'];
    $amount = $_POST['amount'];

    $reqInsert = $db->prepare("INSERT INTO movements (`idBankAccount`, `name`,`idCategory`, `amount`, `paymentMethod`) VALUES (:account, :nameMovement, :category, :amount, :method)");
    $reqInsert->execute(array("account"=>$account, "nameMovement"=>$name, "category"=>$category, "amount"=>$amount, "method"=>$method));

    $reqInsert->closeCursor();

    $category = $_POST['type'];
    $reqSelect = $db->prepare("SELECT `type` FROM category WHERE id = :id");
    $reqSelect->execute(array("id"=>$category));
    $data = $reqSelect->fetchAll();
    $data[0]['type'];

    $reqUpdate = $db->prepare("UPDATE bankAccounts SET amount = amount " . ($data[0]['type'] == "credit" ? "+" : "-") . " :amountMovement WHERE id = :id");
    $reqUpdate->execute(array("id"=>$account, "amountMovement"=>$amount));


}

?>