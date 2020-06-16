<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link href="css/inscription.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <title>LBE - Connexion</title>
</head>

<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

if(isset($_POST['formconnect']))
{
    $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($pseudoconnect AND !empty($mdpconnect)))
    {
        $requser = $bdd->prepare("SELECT * FROM membre WHERE pseudo = ? AND mdp = ?");
        $requser->execute(array($pseudoconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
            $userinfo = $requser->fetch(); 
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['mail'] = $userinfo['mail'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            header("Location: profil.php?id=".$_SESSION['id']);
        }
        else
        {
            $erreur = "Pseudo ou mot de passe invalide.  ";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être remplis!";
    }
}

?>

<body id="home" class="scrollspy">

    <!-- Navbar -->

    <div class="navbar-fixed">
        <nav class="green">
            <div class="container">
                <div class="nav-wrapper"></div>
                <a href="index.php" class="brand-logo"><img src="logo.png" alt="logo"></a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a href="inscription.php" class="white-text">S'inscrire</a>
                        </li>
                        <li>
                            <a href="connection.php" class="white-text">Se connecter</a>
                        </li>
                    </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-nav">
        <li>
            <a href="inscription.php">S'inscrire</a>
        </li>
        <li>
            <a href="connection.php">Se connecter</a>
        </li>
    </ul>

        <!-- Section : erreur connexion -->

    <section>
        <h5 class="red-text center-align">
        <?php
            if(isset($erreur)){
                echo $erreur;
            }
        ?>
        </h5>
    </section>

    <!-- Section : Connexion -->

    <div class="row">
        <form method="POST" action="" class="col s10 m4 offset-m4">
            <div class="card">
                <div class="card-action green white-text">
                    <h4 class="center-align">Connexion</h4>
                </div>

                <div class="input-field col s12">
                    <label for="text">Pseudo : *</label>
                    <input type="text" id="pseudoconnect" name="pseudoconnect" class="validate">
                </div>

                <div class="input-field col s12">
                    <label for="mdp">Mot de passe : *</label>
                    <input type="password" id="mdpconnect" name="mdpconnect"  class="validate">
                </div>  

                <button class="btn waves-effect green white-text" type="submit" name="formconnect">Se connecter
                    <i class="material-icons right">send</i>
                </button>
                
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
    // Sidenav
        const sideNav = document.querySelector('.sidenav');
        M.Sidenav.init(sideNav, {}); 
    </script>

</body>

</html>