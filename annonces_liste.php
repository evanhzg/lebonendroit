<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

$reqannonce = $bdd->query("SELECT * FROM annonce");
$annonce = $reqannonce->fetchAll();

// $ownerId = $annonce['owner_id'];
// $reqowner = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
// $reqowner->execute(array($ownerId));
// $owner = $reqowner->fetch();
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
    
    <title>Liste des annonces - LBE</title>
</head>

<body id="home" class="scrollspy">

    <!-- Navbar -->

    <div class="navbar-fixed">
        <nav class="green">
            <div class="container">
                <div class="nav-wrapper"></div>
                    <a href="index.php" class="brand-logo white-text">Le Bon Endroit</a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a href="creer_annonce.php" class="white-text">Déposer une annonce</a>
                        </li>
                        <?php
                        if(isset($_SESSION['id']))
                        {
                        ?>
                        <li>
                            <a href="deconnexion.php" class="white-text">Se deconnecter</a>
                        </li>
                        <?php
                        }
                        else
                        {
                        ?>
                        <li>
                            <a href="inscription.php" class="white-text">S'inscrire</a>
                            <a href="connexion.php" class="white-text">Se connecter</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-nav">
        <li>
            <a href="#deposer">Déposer une annonce</a>
        </li>
        <li>
            <a href="deconnexion.php">Se deconnecter</a>
        </li>
    </ul>

<section id="popular" class="section section-popular scrollspy">
    <?php
    for ($i = 0; $i < count($annonce); $i++)
    {
    ?>
        <div class="container">
            <div class="card-panel white center-align">           
                <span class="black-text"><?php echo $annonce[$i]['title']; ?></span>
                <br>
                <span class="black-text"><?php echo $annonce[$i]['price']; ?></span>
                <br>
                <!-- <span class="black-text"><?php echo $owner[$i]['pseudo']; ?></span>
                <br> -->
                <a href="annonce.php?id=<?php echo $annonce[$i]['id']; ?>">Voir l'annonce</a>
                <br><br>
            </div>
        </div>
    <?php
    }
    ?>
</section>

</div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
    // Sidenav
        const sideNav = document.querySelector('.sidenav');
        M.Sidenav.init(sideNav, {}); 
    </script>

</body>

</html>