<!DOCTYPE html>
<html lang="en">

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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion - LBE</title>

    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>
    <div align="center">
        <h2>Connexion</h2>
        <br><br><br>
        <form method="POST" action="">
            <input type="text" name="pseudoconnect" placeholder="Pseudo">
            <input type="password" name="mdpconnect" placeholder="Mot de passe">
            <input type="submit" name="formconnect" value="Connexion">
        </form>
        <br><br><br>
        <?php
        if(isset($erreur))
        {
            echo '<font color = "red">'.$erreur."</font>";
        }
        ?>

    </div>
</body>

</html>