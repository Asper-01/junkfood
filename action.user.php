<?php
require_once 'config.php';    // On inclut la Connexion à la Bdd


$update = false;
$id = "";
$pseudo = "";
$nom = "";
$prenom = "";
$email = "";
$adresse = "";
$code_postal = "";
$ville = "";


// *******************************  CRUD  ********************************

// Si les champs sont remplis:
// var_dump('<pre>', $_POST);exit;
if (isset($_POST['add'])) {
	$pseudo = $_POST['pseudo'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$adresse = $_POST['adresse'];
	$code_postal = $_POST['code_postal'];
	$ville = $_POST['ville'];




	// ******************  CRUD AJOUTER ********************

	// On prépare la requête SQL
	$stmt = $bdd->prepare("INSERT INTO user(pseudo,nom,prenom,email,adresse,code_postal,ville)VALUES(:pseudo,:nom,:prenom,:email,:adresse,:code_postal,:ville)");
	// On execute la requête SQL
	$stmt->execute(['pseudo' => $pseudo, 'nom' => $nom, 'prenom' => $prenom, 'email' => $email, 'adresse' => $adresse, 'code_postal' => $code_postal, 'ville' => $ville]);

	// On renvoie l'utilisateur à la page CRUD + message de confirmation
	header('location:monCompte.php');
	$_SESSION['response'] = "Insertion réussie en base de donnée !";
	$_SESSION['res_type'] = "success";
}


// ******************  CRUD EDITION MAJ ********************
// Vérifier si un post update est réalisé
// Vérifier si l'user a le droit de modifier les données (pas besoin de récupérer toutes les infos)
// Si oui
// Controler les données envoyées par le formulaire
// Si elles sont bonnes
// Les envoyer en BDD
// Afficher une confirmation de MAJ des données
// Si non gérer un tableau d'erreurs
// Et afficher la vue du formulaire
// Si non
// Gérer une erreur


if (isset($_POST['update'])) {
	// Vérifier si un post update est réalisé
	$id = $_SESSION['id'];
	//recupération de l'id de Session utilisateur
	$stmt = $bdd->prepare("SELECT id FROM user WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	if (empty($row)) {
		// Si non
		// Erreur, l'user n'a pas le droit/n'existe pas		
	} else {
		// Si oui
		$updateOk = false;
		//controller si les données sont définies correctement ( à implémenter)
		$pseudo = $_POST['pseudo'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$adresse = $_POST['adresse'];
		$code_postal = $_POST['code_postal'];
		$ville = $_POST['ville'];

		$stmt = $bdd->prepare("UPDATE user SET pseudo=:pseudo,nom=:nom,prenom=:prenom,email=:email,adresse=:adresse,code_postal=:code_postal,ville=:ville WHERE id=:id");
		try {
			$params = [
				"pseudo" => $pseudo,
				"nom" => $nom,
				"prenom" => $prenom,
				"email" => $email,
				"adresse" => $adresse,
				"code_postal" => $code_postal,
				"ville" => $ville,
				"id" => $id,
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

	var_dump('Debug END');
	exit;
}

// Si tous les champs sont présents
/*if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$pseudo = $_POST['pseudo'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$adresse = $_POST['adresse'];
	$code_postal = $_POST['code_postal'];
	$ville = $_POST['ville'];

	//Execution de la MAJ
	$stmt = $bdd->prepare("UPDATE user SET pseudo=:pseudo,nom=:nom,prenom=:prenom,email=:email,adresse=:adresse,code_postal=:code_postal,ville=:ville WHERE id=:id");
	$stmt->execute(["pseudo" => $pseudo, "nom" => $nom, "prenom" => $prenom, "email" => $email, "adresse" => $adresse, "code_postal" => $code_postal, "ville" => $ville]);

	// Définition des variables de session
	$_SESSION['response'] = "Mise a jour effectuée !";
	$_SESSION['res_type'] = "primary";

	// Redirection vers la page CRUD + message de confirmation
	header('location:monCompte.php');
	exit();
}*/

// ******************  CRUD DETAILS AFFICHAGE ********************
if (isset($_GET['details'])) {
	$id = $_GET['details'];
	$stmt = $bdd->prepare("SELECT * FROM user WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	$vid = $row['id'];
	$vpseudo = $row['pseudo'];
	$vnom = $row['nom'];
	$vprenom = $row['prenom'];
	$vemail = $row['email'];
	$vadresse = $row['adresse'];
	$vcode_postal = $row['code_postal'];
	$vville = $row['ville'];
}

if (isset($_GET['edit'])) {
	// Affichage du formulaire d'édition
	$id = $_GET['edit'];

	$stmt = $bdd->prepare("SELECT * FROM user WHERE id=:id");
	$stmt->execute(["id" => $id]);
	$row = $stmt->fetch();

	$id = $row['id'];
	$pseudo = $row['pseudo'];
	$nom = $row['nom'];
	$prenom = $row['prenom'];
	$email = $row['email'];
	$adresse = $row['adresse'];
	$code_postal = $row['code_postal'];
	$ville = $row['ville'];
	$update = true;
}
