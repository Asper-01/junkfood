<?php
require_once '../config.php';  // On inclut la Connexion à la Bdd
require_once '../fonction.php';

if (!AdminConnected()) {
	header('location:../index.php');
}

$update = false;
$id = "";
$nom = "";
$preparation = "";
$prix = "";
$newimage = "";
$categorie = "";



// ******************  CRUD DETAILS AFFICHAGE ********************

if (isset($_GET['details'])) {
	$id = $_GET['details'];
	$stmt = $bdd->prepare("SELECT * FROM plats WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$preparation = $_POST['preparation'];
	$prix = $_POST['prix'];
	$oldimage = $_POST['oldimage'];
	$categorie = $_POST['categorie'];
}

if (isset($_GET['edit'])) {
	// Affichage du formulaire d'édition
	$id = $_GET['edit'];

	$stmt = $bdd->prepare("SELECT * FROM plats WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$preparation = $_POST['preparation'];
	$prix = $_POST['prix'];
	$oldimage = $_POST['oldimage'];
	$categorie = $_POST['categorie'];
	$update = true;
}

if (isset($_POST['update'])) {
	// Vérifier si un post update est réalisé
	$stmt = $bdd->prepare("SELECT * FROM plats WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	$updateOk = false;
	//controller si les données sont définies correctement ( à implémenter)
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
	try {
		$params = [
			"id" => $id,
			"nom" => $nom,
			"preparation" => $preparation,
			"prix" => $prix,
			"categorie" => $categorie,
			"photo" => $newimage,

		];
		$row = $stmt->execute($params);
		if ($row === false) {
			throw new Exception("'Erreur d'insertion des données");
		} else {
			$updateOk = true;
		}
	} catch (Exception $e) {
		var_dump('Exception', $e);
		exit;
	}

	// Données à jour
	if ($updateOk) {
		// Définition des variables de session
		$_SESSION['response'] = "Mise a jour effectuée !";
		$_SESSION['res_type'] = "primary";
		unset($params['id']);
		foreach ($params as $key => $row) {
			$_SESSION[$key] = $row;
		}

		// Redirection vers la page CRUD + message de confirmation
		header('location:monCompte.php');
		exit();
	}
}


include 'view/updateView.php'; // On inclut le fichier updateView pour l'affichage
