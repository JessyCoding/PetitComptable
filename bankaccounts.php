<?php

    include_once 'utils.php';

    if (isset($_POST['submitCreateBA'])){
        create_bankaccount();
    }
    else if (isset($_POST['submitDeleteBA'])){
        delete_bankaccount();
    }
    else header("Localtion: form_bankaccounts.php");

    function create_bankaccount(){
        $nameAccount = $_POST['name']; 
        $compte = $_POST['type'];
        $provision = $_POST['provision']; 
        $monaie = $_POST['devise'];
        $userId = $_SESSION['id'];
        
        $db = db_connect();
        //insert
    
        $req = $db->prepare("INSERT INTO bankAccounts (idUser, name, type, amount, devise) VALUES (:userId,:name,:type,:amount,:devise)");
        $req->execute(array(
                "userId"    => $userId, 
                "name"      => $nameAccount, 
                "type"      => $compte, 
                "amount"    => $provision, 
                "devise"    => $monaie));
                
        $req->closeCursor();

        header("Location: form_movements.php");
    }

    function delete_bankaccount(){
        $db = db_connect();
        $account = $_POST['account'];
        //delete 
        
        delete_movements($db, $account);

        $reqDelBA= $db->prepare("DELETE FROM bankAccounts  WHERE idUser = ?");
        $reqDelBA->execute(array($account));
        $reqDelBA->closeCursor();

        header("Location: form_bankaccounts.php");
    }

?>