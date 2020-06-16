<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(empty($_SESSION))
{
    header("Location : index.php");
}

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

    if(isset($_FILES['photos']) AND !empty($_FILES['photos']['name']))
    {
        $tailleMax = 2097152;
        $extensions = array('jpg', 'jpeg', 'png', 'gif');
        if ($_FILES['avatar']['size'] <= $tailleMax)
        {
            $extensionUpld = strtolower(substr(strrchr($_FILES['photos']['name'], '.'), 1));
            if(in_array($extensionUpld, $extensions))
            {
                $chemin = "annonces/photos/".$_GET['id'].".".$extensionUpld;
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

                if($resultat)
                {
                    $updatePhotos = $bdd->prepare("UPDATE annonce SET photo = :photo WHERE id = :id");
                    $updatePhotos->execute(array(
                        'photo' => $_GET['id'].".".$extensionUpld,
                        'id' => $_GET['id']
                    ));
                    header("Location: profil.php?id=".$_SESSION['id']);
                }
                else
                {
                    $erreur = "erreur d'importation. réessayer.";
                }
            }
            else
            {
                $erreur = "Cette extension de fichier n'est pas reconnue. jpg, jpeg, png et gif uniquement.";
            }
        }
        else
        {
            $erreur = "Vots photos ne peuvent pas dépasser 2Mo.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Créer une annonce - LBE</title>
</head>
<body>

<form method="POST">

    <div>
        <label for="owner">Annonceur: </label>
        <input type="text" id="owner" name="owner" readonly value="<?= $_SESSION['pseudo']; ?>">
    </div>
    <br><br>
    <div>
        <label for="category_id">Statut *</label>
        <select name="category_id" class="validate">
            <option value="1">Vêtements</option>
            <option value="2">Décoration</option>
            <option value="3">Bricolage</option>
            <option value="4">Animaux</option>
            <option value="5">Immobilier</option>
            <option value="6">Voitures</option>
        </select>
    </div>
    <br>
    <div>
        <label for="title">Titre *</label>
        <input type="text" id="title"  name="title"  placeholder="Insérer titre..." class="validate" required>
    </div>
    <br>
    <div>
        <label for="price">Prix *</label>
        <input type="number" id="price"  name="price" placeholder="0.00" class="validate" required>
        <label for="price">€</label>
    </div>
    <br>
    <div>
        <label for="description">Description *</label>
        <input type="textarea" id="description"  name="description" placeholder="Insérer une description..." class="validate" required>
    </div>
    <br>
    <div>
        <label for="status">Statut *</label>
        <select name="status" class="validate">
            <option value="1">Actif</option>
            <option value="2">Inactif</option>
        </select>
    </div>

    <div>
    <br><br>
        <label for="photo1">Photo 1</label>
        <input type="file" id="photo" name="photo" multiple="multiple" class="validate">
        <label for="photo2">Photo 2</label>
        <input type="file" id="photo" name="photo" multiple="multiple" class="validate">
        <label for="photo3">Photo 3</label>
        <input type="file" id="photo" name="photo" multiple="multiple" class="validate">
    </div>
    <br>
    <button type="submit" name="formannonce">Publier l'annonce</button>
</form>


<?php 
if (isset($erreur))
{
    echo $erreur;
}
?>
</body>
</html>