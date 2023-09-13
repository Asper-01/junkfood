<?php
include '../config.php';  // On inclut la Connexion à la Bdd
include '../fonction.php';  //Include des fonctions pour vérification isAdmin

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
	header('location:/admin/product.php');
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




include 'view/updateView.php'; // On inclut le fichier updateView pour l'affichage
