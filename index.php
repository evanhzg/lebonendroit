<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <link href="css/main.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
    <title>Le Bon Endroit - Site d'annonces</title>
</head>

<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');
?>

<body id="home" class="scrollspy">

    <!-- Navbar -->

    <div class="navbar-fixed">
        <nav class=" green">
            <div class="container">
                <div class="nav-wrapper"></div>
                    <a href="index.php" class="brand-logo">Le Bon Endroit</a>
                    <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>
                    <ul class="right hide-on-med-and-down">
                        <li>
                            <a href="creer_annonce.php">Déposer une annonce</a>
                        </li>
                        <?php
                        if(isset($_SESSION['id']))
                        {
                        ?>
                            <li>
                                <a href="deconnexion.php">Se déconnecter</a>
                            </li>
                        <?php
                        }
                        else
                        {
                        ?>
                            <li>
                                <a href="inscription.php">S'inscrire</a>
                            </li>
                            <li>
                                <a href="connexion.php">Se connecter</a>
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
            <a href="inscription.php">S'inscrire</a>
        </li>
        <li>
            <a href="connection.php">Se connecter</a>
        </li>
    </ul>

    <!-- Slider -->

    <section class="slider">
        <ul class="slides">
            <li>
                <img src="banniere1.jpg">
                <div class="caption center-align black-text">
                    <h4>Bienvenue sur</h4>
                    <h2 class="light black-text text-lighten-3">LE BON ENDROIT</h2>
                </div>
            </li>
            <li>
                <img src="banniere2.jpg">
                <div class="caption center-align black-text">
                    <h3 class="light black-text text-lighten-3">Des annonces pour chaque choses dont vous souhaitez.</h3>
                </div>
            </li>
        </ul>
    </section>

    <!-- Section : Search -->

    <section id="search" class="section section-search green darken-1 white-text center scrollspy">
        <div class="contaier">
            <div class="row">
                <div class="col s12">
                    <h4>Quelle catégorie cherchez vous?</h4>
                    <div class="input-field">
                        <input type="text" class="white grey-text autocomplete" id="autocomplete-input" placeholder="Ordinateurs, bricolage, emploi...">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section : Popular announces 1-->

    <section id="popular" class="section section-popular scrollspy">
        <div class="container">
            <div class="row">
                <h5 class="center">
                    <span class="green-text">Catégories Populaire<span> 
                </h5>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="clothes.jpg" alt="">
                            <span class="card-title">
                                <a href="annonces.vetements.php" class="white-text">Vêtements</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="deco.jpg" alt="">
                            <span class="card-title">
                                <a href="annonces.deco.php" class="white-text">Décorations</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                    <div class="card-image">
                            <img src="diy.jpg" alt="">
                            <span class="card-title">
                                <a href="annonces.diy.php" class="white-text">Bricolage</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section : Popular announces 2-->

    <section id="popular" class="section section-popular scrollspy">
        <div class="container">
            <div class="row">
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="pets.jpg" alt="">
                            <span class="card-title">
                                <a href="annonces.pets.php" class="white-text">Animaux</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="immo.jpg" alt="">
                            <span class="card-title">
                                <a href="annonces.immo.php" class="white-text">Immobilier</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="card">
                    <div class="card-image">
                            <img src="cars.jpg" alt="">
                            <span class="card-title">
                                <a href="annonces.car.php" class="white-text">Voitures</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section : Social Medias -->

    <section class="section section-follow darken-2 green-text center">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h5>Retrouvez-nous sur</h5>
                    <a href="#" class="green-text">
                        <i class="fab fa-facebook fa-3x"></i>
                    </a>
                    <a href="#" class="green-text">
                        <i class="fab fa-instagram fa-3x"></i>
                    </a>
                    <a href="#" class="green-text">
                        <i class="fab fa-twitter fa-3x"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
    // Sidenav
        const sideNav = document.querySelector('.sidenav');
        M.Sidenav.init(sideNav, {}); 
    
    // Slider
        const slider = document.querySelector('.slider');
        M.Slider.init(slider, {
            indicators: false,
            height: 500,
            transition: 500,
            interval: 6000
        });

    // Autocomplete on search bar
        const ac = document.querySelector('.autocomplete');
        M.Autocomplete.init(ac,{
            data: {
                "Vêtements": null,
                "Bricolage": null,
                "Décorations": null,
                "Animaux": null,
                "Immobilier": null,
                "Voitures": null,
            }
        });
    </script>
</body>

<footer class="section green darken-2 white-text center">
    <p>&copy; Le Bon Endroit 2020</p>
</footer>

</html>