<!DOCTYPE html>
<html lang="en">

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
    <title>Profil de <?php echo $_SESSION['pseudo'];?></title>

    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>
    <div align="center">
        <h2>Modifier le profil de <?php echo $_SESSION['pseudo']; ?>:</h2>
        <br><br><br>
         
        <form action="POST">
        <table>
                <tr>
                    <td align="right">
                        <label for="newpseudo">Nouveau pseudo? </label>
                    </td>
                    <td align="right">
                        <input type="text" placeholder="Nouveau pseudo" id="newpseudo" name="newpseudo" value="<?php echo $user['pseudo']; ?>">
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <label for="newmail">Nouveau mail? </label>
                    </td>
                    <td align="right">
                        <input type="email" placeholder="Nouveau mail" id="newmail" name="newmail" value="<?php echo $user['mail'];?>">
                    </td>
                </tr>
                
                <tr>
                    <td align="right">
                        <label for="newmdp">Nouveau mot de passe?</label>
                    </td>
                    <td align="right">
                        <input type="password" placeholder="Nouveau mot de passe" id="newmdp" name="newmdp">
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <label for="newmdp2">Confirmer Mot de passe:</label>
                    </td>
                    <td align="right">
                        <input type="password" placeholder="Confirmer mot de passe" id="newmdp2" name="newmdp2">
                    </td>
                </tr>
            </table>
            <br />
            <input type="submit" value="Modifier le profil">
        </form>
    </div>
<?php
}
else
{
    header("Location: connexion.php");
}
?>
</body>

</html>