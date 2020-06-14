<!DOCTYPE html>
<html lang="en">
    
<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

if(isset($_POST['formannonce']))
{
    $owner = htmlspecialchars($_SESSION['pseudo']);
    $title = htmlspecialchars($_POST['title']);
    $price = htmlspecialchars($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $active = htmlspecialchars($_POST['active']);

    if(!empty($_POST['title']) AND !empty($_POST['price']) AND !empty($_POST['description']))
    {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insertmbr = $bdd->prepare("INSERT INTO annonce (owner, title, price, description, active) VALUES (?, ?, ?, ?, ?)");
        $insertmbr->execute(array($owner, $title, $price, $description, $active));
        $erreur = "Annonce créée avec succès!";
        $latest_id = $conn->lastInsertId();
        //header('Location: annonce.php?id='.$latest_id);
        echo $owner, $title, $price, $description, $active;
    }
    else
    {
        $erreur = "Tous les champs contenant une * doivent être remplis!";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Créer une annonce - LBE</title>
</head>
<body>

<form action="POST">

    <div>
        <label for="owner">Annonceur: </label>
        <input type="text" id="owner" name="owner" readonly value="<?= $_SESSION['pseudo']; ?>">
    </div>
    <br><br>
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
        <label for="description">Description</label>
        <input type="textarea" id="description"  name="description" placeholder="Insérer une description..." class="validate" required>
    </div>
    <br>
    <div>
        <label for="status">Statut *</label>
        <select name="Statut">
            <option>Actif</option>
            <option>Inactif</option>
        </select>
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