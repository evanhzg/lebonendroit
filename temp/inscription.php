<!DOCTYPE html>
<html lang="en">

<?php

//initialisation de la base de données
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

//récupération des données du formulaire pour les transférer sur la base de données
if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    {
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255)
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
                            $insertmbr = $bdd->prepare("INSERT INTO membre (pseudo, mail, mdp) VALUES (?, ?, ?)");
                            $insertmbr->execute(array($pseudo, $mail, $mdp));
                            $erreur = "Compte créé avec succès! <a href=\"connexion.php\">Me connecter</a>";
                        }
                        else
                        {
                            $erreur = "Vos mots de passe diffèrent!";
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
                    $erreur = "Votre mail n'est pas valide!";
                }
            }
            else
            {
                $erreur = "Les deux champs 'mail' doivent correspondre!";
            }
        }
        else
        {
            $erreur = "Votre pesudo ne doit pas dépasser 255 caracteres!";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être remplis.";
    }
}

?>

<!-- génération du head-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inscription - LBE</title>

    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>
    <div align="center">    <!-- le align permet de mettre tout au milieu sans css mais ducoup on le retirera -->
        <h2>Inscription</h2>    <!-- titre modifiable, juste pour dire que c'est la page d'inscription -->
        <br><br><br>
        <form method="POST" action="">  <!-- formulaire, on peut le refaire tant que les input ont les attributs qui sont en dessous -->
            <table>
                <tr>
                    <td align="right">  <!-- label retirable ou modifiable -->
                        <label for="pseudo">Pseudo:</label>
                    </td>
                    <td align="right">
                        <input type="text" placeholder="Pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>">
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <label for="mail">Mail:</label>
                    </td>
                    <td align="right">
                        <input type="email" placeholder="Mail" id="mail" name="mail">
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <label for="mail2">Confirmer Mail:</label>
                    </td>
                    <td align="right">
                        <input type="email" placeholder="Confirmation Mail" id="mail2" name="mail2">
                    </td>
                </tr>
                
                <tr>
                    <td align="right">
                        <label for="mdp">Mot de passe:</label>
                    </td>
                    <td align="right">
                        <input type="password" placeholder="Mot de passe" id="mdp" name="mdp">
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        <label for="mdp2">Confirmer Mot de passe:</label>
                    </td>
                    <td align="right">
                        <input type="password" placeholder="Confirmer Mot de passe" id="mdp2" name="mdp2">
                    </td>
                </tr>
            </table>
            <br />
            <input type="submit" name="forminscription" value="S'inscrire"> <!-- le bouton est modifiable et tout, faut juste que ce soit avec les memes attributs et que ce soit un input et non un button -->
        </form>
        <br><br><br>
        <?php
        //le $erreur renvoie un message selon l'erreur, on le print en echo mais on peut le styliser et tout
        if(isset($erreur))
        {
            echo '<font color = "red">'.$erreur."</font>";
        }
        ?>

    </div>
</body>

</html>