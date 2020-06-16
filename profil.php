<?php

session_start();

$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();

    $reqannonce = $bdd->prepare("SELECT * FROM annonce WHERE owner_id = ?");
    $reqannonce->execute(array($getid)); //donne 18 entrées pour seulement 2 annonces donc chelou chelou quand meme (fait pareil pour nimporte quel nbr d'annonces)
    $annonce = $reqannonce->fetchAll();
    
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
    
    <title><?php echo "Profil de "; echo $userinfo['nom']; echo " "; echo $userinfo['prenom'];?></title>
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
                        <li>
                            <a href="deconnexion.php" class="white-text">Se deconnecter</a>
                        </li>

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
                    <span class="black-text"><?php echo $userinfo['prenom']." ".$userinfo['nom'] ?><span>
                    <br>
                    <?php
                    if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
                    {
                    ?>
                        <span class="black-text"><?php echo "'"; echo $userinfo['pseudo']; echo "'";  ?><span>
                    <?php
                    }
                    ?>
                </h4>
                <div class="row">
                    <div class="col s12 m5">
                        <div class="card-panel white center-align">
                            <?php
                            if(!empty($userinfo['avatar']))
                            {
                            ?>
                                <img src="img/membres/<?php echo $userinfo['avatar']; ?>" style="width:200px; height:200px; object-fit:cover; border-radius:50%;" >
                                <br><br><br>
                            <?php
                            }
                            ?>
                            <span class="black-text">Mes informations :</span><br>
                            <span class="black-text">E-mail : <?php echo $userinfo['mail']; ?></span>
                            <br>
                            <span class="black-text">Nom : <?php echo $userinfo['nom']; ?></span>
                            <br>
                            <span class="black-text">Prénom : <?php echo $userinfo['prenom']; ?></span>
                            <p class="center">        
                            <?php
                            if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
                            {
                            ?>
                                <a href="modifier.php">Editer mon profil</a><br>
                            <?php
                            }
                            else
                            {
                            ?>
                                <a href="messages.php">Envoyer un message</a><br>
                            <?php
                            }
                            ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- affichage des articles de l'utilisateur -->
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
                <a href="annonce.php?id=<?php echo $annonce[$i]['id']; ?>">Voir l'annonce</a>
                <br><br>
            </div>
        </div>
    <?php
    }
    ?>
    </section>
    
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