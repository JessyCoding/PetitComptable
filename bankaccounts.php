<?php

    include_once 'utils.php';
    include_once 'movements.php';

    echo var_dump($_POST);

    if (isset($_POST['submitCreateBA'])){
        create_bankaccount();
    }
    else if (isset($_POST['submitDeleteBA'])){
        delete_bankaccount();
    }
    else header("Localtion: form_bankaccounts.php");

    function create_bankaccount(){
        $bas = get_userbankaccounts();
        if(count($bas) == 10){
            header("Location: form_bankaccounts.php");
            return;
        } 

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
                "name"      => htmlspecialchars($nameAccount), 
                "type"      => $compte, 
                "amount"    => $provision, 
                "devise"    => $monaie));
                
        $req->closeCursor();

        header("Location: form_movements.php?id=".$db->lastInsertId());
    }

    function delete_bankaccount(){
        $db = db_connect();
        $account = $_POST['account'];
        //delete 
        
        delete_movements($db, $account);

        $reqDelBA= $db->prepare("DELETE FROM bankAccounts  WHERE id = ?");
        $reqDelBA->execute(array($account));
        $reqDelBA->closeCursor();

        header("Location: form_bankaccounts.php");
    }

?>