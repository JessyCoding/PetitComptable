<?php
    unset($_SESSION);
?>

<!DOCTYPE   html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
       
    </head>
    <body>
        <form method="POST" action="login.php">
            <p>
                <span>Le petit compatble</span>
            </p>
            <input type="text" name="pseudo" placeholder="Votre username" /><br>
            <input type="password" name="mdp" placeholder="Votre Mot de passe" /><br>
            <input type="submit" name="submitLogin" value="Valider">
        </form>
    </body>
</html>