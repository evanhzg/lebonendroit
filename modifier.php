<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=leboncoin', 'root', '');

if(isset($_SESSION['id']))
{
    $requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']); 
        $insertpseudo = $bdd->prepare("UPDATE membre SET pseudo = ? WHERE id = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom'])
    {
        $newnom = htmlspecialchars($_POST['newnom']); 
        $insertnom = $bdd->prepare("UPDATE membre SET nom = ? WHERE id = ?");
        $insertnom->execute(array($newnom, $_SESSION['id']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']); 
        $insertprenom = $bdd->prepare("UPDATE membre SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($newprenom, $_SESSION['id']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }
    
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        $newmail = htmlspecialchars($_POST['newmail']); 
        $insertmail = $bdd->prepare("UPDATE membre SET mail = ? WHERE id = ?");
        $insertmail->execute(array($newmail, $_SESSION['id']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND $_POST['newmdp'] != $user['mdp'])
    {
        if($_POST['newmdp'] == $_POST['newmdp2'])
        {
            $newmdp = sha1($_POST['newmdp']);
            $insertmdp = $bdd->prepare("UPDATE membre SET mdp = ? WHERE id = ?");
            $insertmdp->execute(array($newmdp, $_SESSION['id']));
            header("Location: profil.php?id=".$_SESSION['id']);
        }
        else
        {
            $erreur = "Les mots de passe de correspondent pas!";
        }
    }

    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
    {
        $tailleMax = 2097152;
        $extensions = array('jpg', 'jpeg', 'png', 'gif');
        if ($_FILES['avatar']['size'] <= $tailleMax)
        {
            $extensionUpld = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
            if(in_array($extensionUpld, $extensions))
            {
                $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpld;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

                if($resultat)
                {
                    $updateAvatar = $bdd->prepare("UPDATE membre SET avatar = :avatar WHERE id = :id");
                    $updateAvatar->execute(array(
                        'avatar' => $_SESSION['id'].".".$extensionUpld,
                        'id' => $_SESSION['id']
                    ));
                    header("Location: profil.php?id=".$_SESSION['id']); 
                }
                else
                {
                    $erreur = "erreur d'importation. réessayer.";
                }
            }
            else
            {
                $erreur = "Cette extension de fichier n'est pas reconnue. jpg, jpeg, png et gif uniquement.";
            }
        }
        else
        {
            $erreur = "Votre photo de profil ne peut pas dépasser 2Mo.";
        }
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
        <form method="POST" action="" enctype="multipart/form-data" class="col s12 m4 offset-m4">
            <div class="card">
                <div class="card-action green white-text">
                    <h4 class="center-align">Modifier mon profil</h4>
                </div>

                <div class="input-field col s12">
                    <label for="pseudo">Nouveau pseudo : </label>
                    <input type="text" id="newpseudo" name="newpseudo" class="validate" value="<?php echo $user['pseudo']; ?>">
                </div>
                
                <div class="input-field col s12">
                    <label for="nom">Nouveau nom : </label>
                    <input type="text" id="newnom" name="newnom" class="validate" value="<?php echo $user['nom']; ?>">
                </div>
                
                <div class="input-field col s12">
                    <label for="prenom">Nouveau prénom : </label>
                    <input type="text" id="newprenom" name="newprenom" class="validate" value="<?php echo $user['prenom']; ?>">
                </div>

                <div class="input-field col s12">
                    <label for="email">Mail : </label>
                    <input type="email" id="newmail" name="newmail" class="validate" value="<?php echo $user['mail']; ?>">
                </div>


                <div class="input-field col s12">
                    <label for="mdp">Mot de passe : </label>
                    <input type="password" id="newmdp"name="newmdp"  class="validate">
                </div>

                <div class="input-field col s12">
                    <label for="mdp2">Confirmer mot de passe : </label>
                    <input type="password" id="newmdp2" name="newmdp2" class="validate">
                </div>

                <div class="form-field">
                    <label for="avatar">Photo de profil : </label>
                    <input type="file" id="avatar" name="avatar" class="validate">
                </div>

                <button class="btn waves-effect green" type="submit" name="forminscription">Modifier le profil
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