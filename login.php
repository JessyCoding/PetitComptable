<?php

    include_once 'utils.php';

    if (isset($_POST['submitLogin'])){
        login();
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
            echo '<script>alert("Mauvais identifiant ou mot de passe , le grand Thanos arrive! veuillez attendre");</script>';
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
                echo '<script>alert("Tu c pa ton mo de pace, t nul");</script>';
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

        echo empty($resultat) ? "true" : "false";

        return $resultat;
    }

?>