<?php
require_once '../config.php';  // On inclut la Connexion à la Bdd
require_once '../fonction.php';  //Include des fonctions pour vérification isAdmin

$id = "";

// ******************  CRUD EFFACER ********************

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // On séléctionne ce qui va être effacé
    $stmt = $bdd->prepare("SELECT * FROM user WHERE id=:id");
    // On efface l'entrée séléctionnée
    $stmt->execute(["id" => $id]);
    $row = $stmt->fetch();

    $stmt = $bdd->prepare("DELETE FROM user WHERE id=:id");
    $stmt->execute(["id" => $id]);
    // On renvoie l'utilisateur à la page CRUD + message de confirmation
    $_SESSION['response'] = "Champ effacé de la base de donnée !";
    $_SESSION['res_type'] = "danger";
    header('location:user.php');
}


require_once 'view/userView.php'; // On inclut le fichier productView pour l'affichage
