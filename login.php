<?php
 session_start();
 echo $_SESSION['id'];
function dbConnect() {
    $host = "localhost";
    $dbName = "petitcomptable";
    $user   = "root";
    $password = "root";

    return new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
}

// Récup du login et de son Mdp

$bdd = dbConnect();

$req = $bdd->prepare('SELECT id, mdp FROM Users WHERE pseudo = :pseudo');
$req->execute(array(
        'pseudo' => $_POST['pseudo']));
$resultat = $req->fetch();


// comparaison du Mdp envoyé via le formulaire à la base

$isMdpCorrect = ($_POST['mdp'] == $resultat['mdp']) ? true : false;

if(!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe , le grand Thanos arrive! veuillez attendre';
 
}
else
{
    if ($isMdpCorrect){
        
        $_SESSION['id']=$resultat['id'];
        $_SESSION['pseudo'] = $_POST['pseudo'];
        echo 'Vous avez réussi à vous connecté au compte '.$resultat['id'].' et donc Thanos est perdu au fin fond du webspace';
    }
    else{
        echo 'Tu c pa ton mo de pace , t nul';
    
    }
    

}


