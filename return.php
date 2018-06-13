
<?php

$nameAccount = $_POST['name']; 
$compte = $_POST['type'];
$provision = $_POST['provision']; 
$monaie = $_POST['devise'];
$userId = 1;

function db_connect(){
    try{
        $host      = "localhost";
        $dbname    = "ptitcomtable";
        $user      = "root";
        $password = "root";

        $db = new PDO(
            "mysql:host=$host;dbname=$dbname",
            $user,
            $password
        );
            return $db;
        }
    catch (Exception $e){
        die('Erreur :'.$e->getMessage());
        }
}

if (isset($_POST['myForm'])){
    $db = db_connect();
    //insert

    $req = $db->prepare("INSERT INTO bankAccounts (idUser, name, type, amount, devise) VALUES (:userId,:name,:type,:amount,:devise)");
    $req->execute(array(
            "userId"    => $userId, 
            "name"      => $nameAccount, 
            "type"      => $compte, 
            "amount"    => $provision, 
            "devise"    => $monaie));

    echo $req->rowCount();
    $lastInsertId = $db->lastInsertId();
    $req->closeCursor();
}

session_start();

$_SESSION['psuedo']=$nameAccount;

if(isset($_SESSION['psuedo'])){

	echo "le psuedo de l'utilisateur est : " . $_SESSION ['psuedo'];
}

if (isset($_SESSION['psuedo'])){
    unset($_SESSION['psuedo']);
}
else 
    session_destroy();
?>