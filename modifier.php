<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id']))
{
    $requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']); 
        $insertpseudo = $bdd->repare("UPDATE membre SET pseudo = ? WHERE id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }
    
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        $newmail = htmlspecialchars($_POST['newmail']); 
        $insertmail = $bdd->repare("UPDATE membre SET mail = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND $_POST['newmdp'] != $user['mdp'] AND $_POST['newmdp'] == $_POST['newmdp2'])
    {
        $newmdp = htmlspecialchars($_POST['newmdp']); 
        $insertmdp = $bdd->repare("UPDATE membre SET mdp = ? WHERE id = ?");
        $insertmdp->execute(array($newmdp, $_SESSION['id']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['pseudo'])
    {
        header("Location: profil.php?id=".$_SESSION['id']);
    }

?>

<?php
}
else
{
    header("Location: connexion.php");
}
?>
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
    
    <title>Modifier mon profil</title>
</head>

<body id="home" class="scrollspy">

    <!-- Navbar -->

    <div class="navbar-fixed">
        <nav class="green">
            <div class="container">
                <div class="nav-wrapper"></div>
                    <a href="index.php" class="brand-logo">Le Bon Endroit</a>

                    <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>

                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a href="profil.php?">Retour au profil</a>
                        </li>

                        <li>
                            <a href="deconnexion.php">Se deconnecter</a>
                        </li>
                    </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-nav">
        <li>
            <a href="profil.php">Retour au profil</a>
        </li>

        <li>
            <a href="deconnexion.php">Se deconnecter</a>
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
        <form method="POST" action="" class="col s12 m4 offset-m4">
            <div class="card">
                <div class="card-action green white-text">
                    <h4 class="center-align">Modifier mon profil</h4>
                </div>

                <div class="div card-content">
                    <div class="form-field">
                        <label for="pseudo">Nouveau pseudo : *</label>
                        <input type="text" id="newpseudo" name="newpseudo" class="validate" value="<?php echo $user['pseudo']; ?>" required>
                    </div>

                    <div class="form-field">
                        <label for="email">Mail : *</label>
                        <input type="email" id="newmail" name="newmail" class="validate" value="<?php echo $user['mail']; ?>" required>
                    </div>


                    <div class="form-field">
                        <label for="mdp">Mot de passe : *</label>
                        <input type="password" id="newmdp"name="newmdp"  class="validate" required>
                    </div>

                    <div class="form-field">
                        <label for="mdp2">Confirmer mot de passe : *</label>
                        <input type="password" id="newmdp2" name="newmdp2" class="validate" required>
                    </div>

                    <button class="btn waves-effect green" type="submit" name="forminscription">Modifier le profil
                        <i class="material-icons right">send</i>
                    </button>
                </div>
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