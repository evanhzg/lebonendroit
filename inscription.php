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
    
    <title>LBE - Inscription</title>
</head>


<?php

$bdd = new PDO('mysql:host=localhost;dbname=leboncoin', 'root', '');

if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']))
    {
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 20)
        {
            if($mail == $mail2)
            {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    $reqmail = $bdd->prepare("SELECT * FROM membre WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();

                    $reqpseudo = $bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
                    $reqpseudo->execute(array($pseudo));
                    $pseudoexist = $reqpseudo->rowCount();
                    if($mailexist == 0 && $pseudoexist == 0)
                    {
                        if($mdp == $mdp2)
                        {
                            $insertmbr = $bdd->prepare("INSERT INTO membre (pseudo, mail, mdp, nom, prenom) VALUES (?, ?, ?, ?, ?)");
                            $insertmbr->execute(array($pseudo, $mail, $mdp, $nom, $prenom));
                            $erreur = "Compte créé avec succès!";
                            header('Location: index.php');
                        }
                        else
                        {
                            $erreur = "Vos mots de passe diffèrent !";
                        }
                    }
                    elseif($mailexist != 0)
                    {
                        $erreur  = "Adresse mail déjà utilisée, veuillez en choisir une autre";
                    }
                    else
                    {
                        $erreur  = "Pseudo déjà utilisé, veuillez en choisir un autre";
                    }
                }
                else
                {
                    $erreur = "Votre mail n'est pas valide !";
                }
            }
            else
            {
                $erreur = "Les deux champs 'mail' doivent correspondre !";
            }
        }
        else
        {
            $erreur = "Votre pesudo ne doit pas dépasser 20 caracteres !";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être remplis.";
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
                            <a href="inscription.php">S'inscrire</a>
                        </li>

                        <li>
                            <a href="connection.php">Se connecter</a>
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

    <!-- Section : erreur inscription -->

    <section>
        <h5 class="red-text center-align">
        <?php
            if(isset($erreur)){
                echo $erreur;
            }
        ?>
        </h5>
    </section>

    <!-- Inscription -->

    <div class="row">
        <form method="POST" action="" class="col s10 m4 offset-m4">
            <div class="card">
                <div class="card-action green white-text">
                    <h4 class="center-align">Inscription</h4>
                </div>

                <div class="input-field col s6">
                    <label for="nom">Nom : *</label>
                    <input type="text" id="nom" name="nom" class="validate">
                </div>

                <div class="input-field col s6">
                    <label for="prenom">Prénom : *</label>
                    <input type="text" id="prenom" name="prenom" class="validate">
                </div>

                <div class="input-field col s12">
                    <label for="pseudo">Pseudo : *</label>
                    <input type="text" id="pseudo" name="pseudo" class="validate">
                </div>

                <div class="input-field col s12">
                    <label for="email">Mail : *</label>
                    <input type="email" id="mail" name="mail" class="validate">
                </div>

                <div class="input-field col s12">
                    <label for="confirm-mail">Confirmer Mail : *</label>
                    <input type="email" id="mail2" name="mail2" class="validate">
                </div>

                <div class="input-field col s12">
                    <label for="mdp">Mot de passe : *</label>
                    <input type="password" id="mdp"name="mdp"  class="validate">
                </div>

                <div class="input-field col s12">
                    <label for="mdp2">Confirmer mot de passe : *</label>
                    <input type="password" id="mdp2" name="mdp2" class="validate">
                </div>

                <button class="btn waves-effect green" type="submit" name="forminscription">S'inscrire
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
