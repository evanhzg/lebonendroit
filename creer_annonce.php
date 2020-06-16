<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=leboncoin', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['formannonce']))
{
    $creator = htmlspecialchars($_SESSION['id']);
    $title = htmlspecialchars($_POST['title']);
    $price = htmlspecialchars($_POST['price']);
    $descr = htmlspecialchars($_POST['description']);
    $dates = date("Y-m-d");
    $status = $_POST['status'];

    if(!empty($_POST['title']) AND !empty($_POST['price']) AND !empty($_POST['description']))
    {
        $insertmbr = $bdd->prepare("INSERT INTO annonce (owner_id, title, price, description, status, dates, category_id, photos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insertmbr->execute(array($creator, $title, $price, $descr, $status, $dates, 1, 1));
        $erreur = "Annonce créée avec succès!";
        $latest_id = $bdd->lastInsertId();
        //header('Location: annonce.php?id='.$latest_id);
        echo "oui";
    }
    else
    {
        $erreur = "Tous les champs contenant une * doivent être remplis!";
    }
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
    
    <title>LBE - Déposer une annonce</title>
</head>
<body id="home" class="scrollspy">

    <!-- Navbar -->

    <div class="navbar-fixed">
        <nav class="green">
            <div class="container">
                <div class="nav-wrapper"></div>
                    <a href="index.php" class="brand-logo"><img src="logo.png" alt="logo"></a>

                    <a href="#" data-target="mobile-nav" class="sidenav-trigger">
                        <i class="material-icons">menu</i>
                    </a>

                    <ul class="right hide-on-med-and-down">

                        <li>
                            <a href="#retour">Retour au profil</a>
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
            <a href="inscription.php">S'inscrire</a>
        </li>

        <li>
            <a href="connection.php">Se connecter</a>
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

    <!-- Déposer une annonce -->
    
    <div class="row">
        <form method="POST" action="" class="col s10 m4 offset-m4">
            <div class="card">
                <div class="card-action green white-text">
                    <h4 class="center-align">Déposer une annonce</h4>
                </div>

                <div class="form-field col s12">
                    <label for="owner">Annonceur :</label>
                    <input disabled value="<?= $_SESSION['pseudo']; ?>" id="owner" type="text" class="validate">
                    
                </div>

                <label class="" for="category_id" name="category_id">Catégorie : *
                    <div class="row center-align">
                        <p class="col s4">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Vêtements</span>
                            </label>
                        </p>
                        <p class="col s4">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Décoration</span>
                            </label>
                        </p>
                        <p class="col s4">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Bricolage</span>
                            </label>
                        </p>
                        <p class="col s4">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Animaux</span>
                            </label>
                        </p>
                        <p class="col s4">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Immobilier</span>
                            </label>
                        </p>
                        <p class="col s4">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Voitures</span>
                            </label>
                        </p>
                    </div>
                </label>

                <div class="input-field col s12">
                    <label for="title">Titre de l'annonce : *</label>
                    <input type="text" id="title" name="title" class="validate" required>
                </div>

                <div class="input-field col s12">
                    <label for="price">Prix : *</label>
                    <input type="number" id="price" name="price" class="validate" required>
                </div>

                <div class="input-field col s12">
                    <label for="description">Description : *</label>
                    <textarea id="description" class="materialize-textarea" class="validate"></textarea>
                </div>

                <div class="row center-align">
                    <label for="status">Statut : *
                        <p class="col s12">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Actif</span>
                            </label>
                        </p>

                        <p class="col s12">
                            <label>
                                <input type="checkbox" class="filled-in"/>
                                <span>Inactif</span>
                            </label>
                        </p>
                    </label>
                </div>

                <button class="btn waves-effect green" type="submit" name="formannonce">Poster l'annonce
                    <i class="material-icons right">send</i>
                </button>

            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    
    <script> 
        $('description').val('New Text');
        M.textareaAutoResize($('description'));
    </script>

    </body>
</html>