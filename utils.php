<?php
    session_start();

    function db_connect(){
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

    function get_categories($db){
        $reqSelect = $db->prepare("SELECT * FROM category");
        $reqSelect->execute();
    
        $data = $reqSelect->fetchAll();
    
        return $data;
    }
    
    function get_category($db, $category){
        $reqSelect = $db->prepare("SELECT * FROM category WHERE id = :id");
        $reqSelect->execute(array("id"=>$category));
    
        $data = $reqSelect->fetchAll();
    
        return $data[0];
    }

    function display_categories(){
        $db = db_connect();
        $categories = get_categories($db);
        echo '<optgroup label="Debit">';
        foreach($categories as $category){
            if($category["type"] == "debit"){
                echo "<option value=".$category["id"].">".$category["name"]."</option>";
            }
        }
        echo "</optgroup>";
        echo '<optgroup label="Credit">';
        foreach($categories as $category){
            if($category["type"] == "credit"){
                echo "<option value=".$category["id"].">".$category["name"]."</option>";
            }
        }
        echo "</optgroup>";
    }
     
    function get_userbankaccounts(){
        $db = db_connect();

        $req = $db->prepare("SELECT * FROM bankAccounts WHERE idUser = ?");
        $req->execute(array($_SESSION['id']));

        $data = $req->fetchAll();

        return $data;
    }

    function get_bankaccount(){
        $db = db_connect();
        
        $req = $db->prepare("SELECT * FROM bankAccounts WHERE id = ?");
        $req->execute(array($_SESSION['account']));

        $data = $req->fetchAll();
        
        return $data[0];
    }

    function display_bankaccounts(){
        $bankaccounts = get_userbankaccounts();

        foreach($bankaccounts as $ba){
            echo '<a href="form_movements.php?id=' . $ba['id'] . '">'.$ba['name'].'</a>';
        }
    }

    function get_movements(){
        $db = db_connect();

        $req = $db->prepare("SELECT * FROM movements WHERE idBankAccount = ?");
        $req->execute(array($_SESSION['account']));

        $data = $req->fetchAll();

        return $data;
    }

    function display_movements(){
        $movements = get_movements();
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Category</th>";
        echo "<th>Amount</th>";
        echo "<th>Method</th>";
        echo "<th></th>";
        foreach($movements as $m){
            echo "<tr>";
            echo '<th>'.$m['name'].'</th>';

            $db = db_connect();
            $cat = get_category($db, $m['idCategory']);
            echo '<th>'.$cat['name'].'</th>';

            echo '<th>'.$m['amount'].'</th>';
            echo '<th>'.$m['paymentMethod'].'</th>';
            echo "<th></th>";        
            echo "</tr>";
        }
    }
?>