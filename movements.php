<?php

include_once "utils.php";

if (isset($_POST['submitCreateM'])) {
    create_movement();
}
else if (isset($_POST['submitEditM'])) {
    edit_movement();
}
else if (isset($_POST['submitDeleteM'])) {
    delete_movement();
}
else header("Location: form_movements.php");

function delete_movements($db, $account){
    $reqDelMvts= $db->prepare("DELETE FROM movements  WHERE idBankAccount = ?");
    $reqDelMvts->execute(array($account));
    $reqDelMvts->closeCursor();
}

function create_movement(){
    $db = db_connect();

    $account = $_SESSION['account'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $method = $_POST['paymentMethod'];
    $amount = $_POST['amount'];

    $req = $db->prepare("INSERT INTO movements (`idBankAccount`, `name`,`idCategory`, `amount`, `paymentMethod`) VALUES (:account, :nameMovement, :category, :amount, :method)");
    $req->execute(array(
        "account"       =>  $account, 
        "nameMovement"  =>  htmlspecialchars($name), 
        "category"      =>  $category, 
        "amount"        =>  $amount, 
        "method"        =>  $method));

    $req->closeCursor();

    apply_movement($db, $account, $amount, $category);
        
    header("Location: form_movements.php");
}
function edit_movement(){
    $db = db_connect();

    $idM = $_POST['idM'];
    $account = $_SESSION['account'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $newCategory = $_POST['newCategory'];
    $method = $_POST['paymentMethod'];
    $amount = $_POST['amount'];
    $newAmount = $_POST['newAmount'];

    apply_movement($db, $account, -$amount, $category);

    $req = $db->prepare("UPDATE movements SET `name` = :nameMovement,`idCategory` = :category, `amount` = :newAmount, `paymentMethod` = :method WHERE id = :idM");
    $req->execute(array(
        "nameMovement"  =>  htmlspecialchars($name), 
        "category"      =>  $newCategory, 
        "newAmount"     =>  $newAmount, 
        "method"        =>  $method,
        "idM"           =>  $idM));

    $req->closeCursor();

    apply_movement($db, $account, $newAmount, $newCategory);
        
    header("Location: form_movements.php");
}

function delete_movement(){
      $db = db_connect();

      $idM = $_POST["idM"];
      $amount = $_POST["amount"];
      $category = $_POST["category"];
      $account = $_SESSION["account"];
  
     apply_movement($db, $account, -$amount, $category);
  
     $reqDelMvts= $db->prepare("DELETE FROM movements  WHERE id = ?");
      $reqDelMvts->execute(array(  $idM = $_POST["idM"]));
      $reqDelMvts->closeCursor();

    header("Location: form_movements.php");    
}

function apply_movement($db, $account, $amount, $category){
    $category = get_category($db, $category);

    $req = $db->prepare("UPDATE bankAccounts SET amount = amount " . ($category['type'] == "credit" ? "+" : "-") . " :amountMovement WHERE id = :id");
    $req->execute(array(
        "id"                =>  $account, 
        "amountMovement"    =>  $amount));
    $req->closeCursor();
}

?>