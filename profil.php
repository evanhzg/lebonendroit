<!DOCTYPE html>
<html lang="en">

<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

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
    <title>Profil de <?php echo $userinfo['pseudo'];?></title>

    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>
    <div align="center">
        <h2>Profil de <?php echo $userinfo['pseudo']; ?></h2>
        <br><br><br>
        Mail = <?php echo $userinfo['mail']; ?>
        <br><br><br>
        <?php
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
        {
        ?>
            <a href="#">Editer mon profil</a>
            <br><br>
            <a href="deconnexion.php">Se déconnecter</a>
        <?php
        }
        ?>

    </div>
</body>

</html>

<?php

}

?>