<?php
require_once '../config.php';  // On inclut la Connexion à la Bdd
require_once '../fonction.php';  //Include des fonctions pour vérification isAdmin

$update = false;
$id = "";
$nom = "";
$preparation = "";
$prix = "";
$photo = "";
$categorie = "";

// *******************************  CRUD  ********************************
// Si les champs sont remplis:

if (isset($_POST['add'])) {
	$nom = $_POST['nom'];
	$preparation = $_POST['preparation'];
	$prix =  $_POST['prix'];
	$photo = $_FILES['image']['name'];
	$upload = "uploads/" . $photo;
	$categorie = $_POST['categorie'];
	
	

	// ******************  CRUD AJOUTER ********************

	// On prépare la requête SQL
	$stmt = $bdd->prepare("INSERT INTO plats (nom,preparation,prix,photo,categorie)VALUES(:nom,:preparation,:prix,:photo,:categorie)");
	// On execute la requête SQL
	$stmt->execute(['nom' => $nom, "preparation" => $preparation, "prix" => $prix, "photo" => $upload, "categorie" => $categorie]);
	// La partie upload du fichier image via un dossier temporaire
	move_uploaded_file($_FILES['image']['tmp_name'], $upload);
	// On renvoie l'utilisateur à la page CRUD + message de confirmation
	header('location:recettes.php');
	$_SESSION['response'] = "Insertion réussie en base de donnée !";
	$_SESSION['res_type'] = "success";

	// ******************  CRUD EFFACER ********************
} else if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	// On séléctionne ce qui va être effacé
	$stmt = $bdd->prepare("SELECT photo FROM plats WHERE id=:id");
	// On efface l'entrée séléctionnée
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();
	$imagepath = $row['photo'];
	unlink($imagepath);
	$stmt = $bdd->prepare("DELETE FROM plats WHERE id=:id");
	$stmt->execute(["id" => $id]);
	// On renvoie l'utilisateur à la page CRUD + message de confirmation
	header('location:recettes.php');
	$_SESSION['response'] = "Champ effacé de la base de donnée !";
	$_SESSION['res_type'] = "danger";
}

// ******************  CRUD EDITION MAJ ********************


if (isset($_GET['edit'])) {    // Editer une entrée de la Bdd
	$id = $_GET['edit'];

	$stmt = $bdd->prepare("SELECT * FROM plats WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	$id = $row['id'];
	$nom = $row['nom'];
	$preparation = $row['preparation'];
	$prix = $row['prix'];
	$photo = $row['photo'];
	$categorie = $row['categorie'];
	$update = true;
}
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$preparation = $_POST['preparation'];
	$prix = $_POST['prix'];
	$oldimage = $_POST['oldimage'];
	$categorie = $_POST['categorie'];
	
	if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
		$newimage = "uploads/" . $_FILES['image']['name'];  //timestamper et garder l'ext du fichier (recup nom fichier + traitement recup extension changer le nom avec un tsmp)
		unlink($oldimage);
		move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
	} else {
		$newimage = $oldimage;
	}

	$stmt = $bdd->prepare("UPDATE plats SET nom=:nom, preparation=:preparation, prix=:prix, categorie=:categorie,photo=:photo WHERE id=:id");
	$stmt->execute(["nom" => $nom, "categorie" => $categorie, "preparation" => $preparation, "photo" => $newimage, "id" => $id, "prix" =>$prix,]);
	$_SESSION['response'] = "Mise a jour effectuée !";
	$_SESSION['res_type'] = "primary";
	header('location:recettes.php');
}




// ******************  CRUD DETAILS AFFICHAGE ********************
if (isset($_GET['details'])) {
	$id = $_GET['details'];
	$stmt = $bdd->prepare("SELECT * FROM plats WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	$vid = $row['id'];
	$vnom = $row['nom'];
	$vpreparation = $row['preparation'];
	$vprix = $row['prix'];
	$vphoto = $row['photo'];
	$vcategorie = $row['categorie'];
	
}



include 'view/productView.php'; // On inclut le fichier updateView pour l'affichage
