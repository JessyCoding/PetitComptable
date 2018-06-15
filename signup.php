<!DOCTYPE   html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>PC - Petit con...</title>
        <link rel="icon" href="logo.png">
       
    </head>
    <body>
        <header> 
            <div id="header"><p class="textNamePres"><span>PETITCOMPTABLE</span></p></div>
        </header>
        <section id="infoSection">
            <div class="logo"><img src="logo.png"/><p class="textNamePres" ><span class="spanWhiteShadow">Inscrivez vous maintenant pour nous rejoindre !</span></div>
            <form method="POST" action="login.php">
                <input type="text" name="pseudo" placeholder="Votre username" /><br>
                <input type="password" name="mdp" placeholder="Votre Mot de passe" /><br>
                <input type="submit" name="submitSignUp" value="Valider">
            </form>
        </section>
    </body>
</html>