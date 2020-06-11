<!DOCTYPE html>
<html lang="en">

<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET(['id'] > 0))
{


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
    <title>Inscription - LBE</title>

    <link rel="stylesheet" href="style/css/style.css">
</head>

<body>
    <div align="center">
        <h2>Profil de</h2>
        <br><br><br>
        
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

<?php

}

?>