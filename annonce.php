<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $reqannonce = $bdd->prepare("SELECT * FROM annonce WHERE id = ?");
    $reqannonce->execute(array($getid));
    $annonce = $reqannonce->fetch();

    $category_id = $annonce['category_id'];
    $reqcategory = $bdd->prepare("SELECT * FROM categories WHERE id = ?");
    $reqcategory->execute(array($category_id));
    $category = $reqcategory->fetch();
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
    
    <title>Annonce LBE - <?php echo $annonce['title'];?></title>
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

<body>

    <!-- Section : Profil de l'utilisateur -->
    <section id="popular" class="section section-popular scrollspy">
        <div class="container">
            <div class="row">
                <h4 class="center">
                    <span class="black-text"><?php echo $category['name']." : ".$annonce['title']; ?><span>
                </h4>
                <div class="row">
                    <div class="col s12 m5">
                        <div class="card-panel white center-align">
                            <span class="black-text">Prix : <?php echo $annonce['price'] ?> €</span><br>
                            <span class="black-text">Description : <?php echo $annonce['description']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

<?php
}
?>