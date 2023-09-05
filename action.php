<?php
include 'config.php';  // On inclut la Connexion à la Bdd
include 'fonction.php';  //Include des fonctions pour vérification isAdmin

$update = false;
$id = "";
$nom = "";
$preparation = "";
$prix = "";
$photo = "";
$categorie = "";





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


