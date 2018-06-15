<?php

    include_once 'utils.php';

    if (isset($_POST['submitLogin'])){
        login();
    }
    else if (isset($_POST['submitGoSignUp'])){
        header("Location: signup.php");
    }
    else if (isset($_POST['submitSignUp'])){
        create_user();
    }
    else header("Location: index.php");

    function login(){
        $user = get_useraccount();
        echo $user['pseudo'];
        echo $user['password'];
        // comparaison du Mdp envoyé via le formulaire à la base

        $isMdpCorrect = ($_POST['mdp'] == $user['password']) ? true : false;

        if(empty($user))
        {
            header("Location: index.php");
        
        }
        else
        {
            if ($isMdpCorrect){
                
                $_SESSION['id']=$user['id'];
                $_SESSION['pseudo'] = $_POST['pseudo'];

                header("Location: form_bankaccounts.php");
            }
            else{
                header("Location: index.php");
            }
        }
    }

    function get_useraccount(){
        // Récup du login et de son Mdp
        $db = db_connect();

        echo empty($db) ? "true" : "false";
        
        $req = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute(array($_POST['pseudo']));
        $resultat = $req->fetch();

        return $resultat;
    }

    function create_user(){
        $user = get_useraccount();
        if($user){
            header("Location: index.php");
            return;
        } 

        $pseudo = $_POST['pseudo']; 
        $password = $_POST['mdp'];
        
        $db = db_connect();
        //insert
    
        $req = $db->prepare("INSERT INTO users (pseudo, password) VALUES (:pseudo,:password)");
        $req->execute(array(
                "password"    => $password, 
                "pseudo"      => htmlspecialchars($pseudo)));
                
        $req->closeCursor();

        header("Location: index.php");
    }

?>