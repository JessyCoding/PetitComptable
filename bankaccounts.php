<?php

    include_once 'utils.php';
    include_once 'movements.php';

    echo var_dump($_POST);

    if (isset($_POST['submitCreateBA'])){
        create_bankaccount();
    }
    else if (isset($_POST['submitGoBA'])){
        header("Location: form_movements.php?id=".$_POST['idBA']);
    }
    else if (isset($_POST['submitEditBA'])){
        edit_bankaccount();
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
        $type = $_POST['type'];
        $amount = $_POST['amount']; 
        $devise = $_POST['devise'];
        $userId = $_SESSION['id'];
        
        $db = db_connect();
        //insert
    
        $req = $db->prepare("INSERT INTO bankAccounts (idUser, name, type, amount, devise) VALUES (:userId,:name,:type,:amount,:devise)");
        $req->execute(array(
                "userId"    => $userId, 
                "name"      => htmlspecialchars($nameAccount), 
                "type"      => $type, 
                "amount"    => $amount, 
                "devise"    => $devise));
                
        $req->closeCursor();

        header("Location: form_movements.php?id=".$db->lastInsertId());
    }

    function edit_bankaccount(){
        $idBA = $_POST["idBA"];
        $nameAccount = $_POST['name']; 
        $type = $_POST['type'];
        $amount = $_POST['amount']; 
        $devise = $_POST['devise'];
        
        $db = db_connect();
        //insert
    
        $req = $db->prepare("UPDATE bankAccounts SET `name` = :nameAcc, type = :type, amount = :amount, devise = :devise WHERE id = :id");
        $req->execute(array(
                "id"        => $idBA, 
                "nameAcc"   => htmlspecialchars($nameAccount), 
                "type"      => $type, 
                "amount"    => $amount, 
                "devise"    => $devise));
                
        $req->closeCursor();

        header("Location: form_bankaccounts.php");
    }

    function delete_bankaccount(){
        $db = db_connect();
        $id = $_POST['idBA'];
        //delete 
        
        delete_movements($db, $id);

        $reqDelBA= $db->prepare("DELETE FROM bankAccounts  WHERE id = ?");
        $reqDelBA->execute(array($id));
        $reqDelBA->closeCursor();

        header("Location: form_bankaccounts.php");
    }

?>