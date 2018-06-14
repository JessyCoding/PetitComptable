<?php
    session_start();

    // define("PAYMENT_METHODS", ["Carte Bleue", "Cheque", "Virement", "Prelevement"]);
    // define("ACCOUNT_TYPES", ["Courant", "Epargne", "Compte joint"]);
    // define("DEVISES", ["USD", "EUR"]); 
    $PAYMENT_METHODS = ["Carte Bleue", "Cheque", "Virement", "Prelevement"];
    $ACCOUNT_TYPES = ["Courant", "Epargne", "Compte joint"];
    $DEVISES = ["USD", "EUR"];

    function db_connect(){
        try{
            $host = "localhost";
            $dbname = "petitcomptable";
            $user = "root";
            $password = "";
    
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

    function display_categories($cat = 1){
        $db = db_connect();
        $categories = get_categories($db);
        echo '<optgroup label="Debit">';
        foreach($categories as $category){
            if($category["type"] == "debit"){
                echo "<option value='".$category["id"].($cat == $category["id"] ? "' selected='selected" : "")."'>".$category["name"]."</option>";
            }
        }
        echo "</optgroup>";
        echo '<optgroup label="Credit">';
        foreach($categories as $category){
            if($category["type"] == "credit"){
                echo "<option value='".$category["id"].($cat == $category["id"] ? "' selected='selected" : "")."'>".$category["name"]."</option>";
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
            echo '<form method="POST" action="bankaccounts.php">';
            echo "<tr>";
            echo '<th><input name="idBA" type="hidden" value="'.$ba['id'].'"/></th>';
            echo '<th><input type="text" name="name" value="'.$ba['name'].'" maxlength="35"/></th>';

            $db = db_connect();
            
            echo '<th><select name="type">';
            display_types($ba["type"]);
            echo '</select></th>';

            echo '<th><input type="number" name="amount" value="'.$ba['amount'].'"/></th>';

            echo '<th><select name="devise">';
            display_devises($ba["devise"]);
            echo '</select></th>';

            echo '<th><input type="submit" name="submitGoBA" value="Gérer"/></th>';        
            echo '<th><input type="submit" name="submitEditBA" value="Editer"/></th>';        
            echo '<th><input type="submit" name="submitDeleteBA" value="Supprimer"/></th>';        
            echo "</tr>";
            echo '</form>';
        }
    }

    function get_movements(){
        $db = db_connect();

        $req = $db->prepare("SELECT * FROM movements WHERE idBankAccount = ? ORDER BY id DESC");
        $req->execute(array($_SESSION['account']));

        $data = $req->fetchAll();

        return $data;
    }

    function display_movements(){
        $movements = get_movements();
        foreach($movements as $m){
            echo '<form method="POST" action="movements.php">';
            echo "<tr>";
            echo '<th><input name="idM" type="hidden" value="'.$m['id'].'"/></th>';
            echo '<th><input type="text" name="name" value="'.$m['name'].'" maxlength="35"/></th>';

            echo '<th><input type="hidden" name="category" value="'.$m['idCategory'].'"/></th>';
            $db = db_connect();
            $cat = get_category($db, $m['idCategory']);
            echo '<th><select name="newCategory">';
            display_categories($cat["id"]);
            echo '</select></th>';

            echo '<th><input type="hidden" name="amount" value="'.$m['amount'].'"/></th>';
            echo '<th><input type="number" name="newAmount" value="'.$m['amount'].'"/></th>';
            echo '<th><select name="paymentMethod">';
            display_paymentMethods($m["paymentMethod"]);
            echo '</select></th>';
            echo '<th><input type="submit" name="submitEditM" value="Editer"/></th>';        
            echo '<th><input type="submit" name="submitDeleteM" value="Supprimer"/></th>';        
            echo "</tr>";
            echo '</form>';
        }
    }

    function display_paymentMethods($pm = "Carte Bleue"){
        global $PAYMENT_METHODS;
        foreach($PAYMENT_METHODS as $paymentMethod){
            echo "<option value='".$paymentMethod.($paymentMethod == $pm ? "' selected='selected" : "")."'>".$paymentMethod."</option>";
        }
    }

    function display_types($batype = "Courant"){
        global $ACCOUNT_TYPES;
        foreach($ACCOUNT_TYPES as $type){
            echo "<option value='".$type.($type == $batype ? "' selected='selected" : "")."'>".$type."</option>";
        }
    }

    function display_devises($badevise = "EUR"){
        global $DEVISES;
        foreach($DEVISES as $devise){
            echo "<option value='".$devise.($devise == $badevise ? "' selected='selected" : "")."'>".$devise."</option>";
        }
    }
?>