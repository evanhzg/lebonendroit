<!DOCTYPE html>
<html lang="en">

<?php

$bdd = new PDO('mysql:host=192.168.64.3;dbname=espace_membre', 'root', '');

if(isset($_POST['forminscription']))
{
    echo "ok";
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Inscription - LBE</title>

    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>
    <div align="center">
        <h2>Inscription</h2>
        <br><br><br>
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo">Pseudo:</label>
                    </td>
                    <td align="right">
                        <input type="text" placeholder="Pseudo" id="pseudo" name="pseudo">
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
            <input type="submit" name="forminscription" value="S'inscrire">

        </form>
    </div>
</body>

</html>