<?php
require_once 'config.php'; 
// On inclut la connexion à la base de données


if (!empty($_POST['email']) && !empty($_POST['password'])) // Si email password ne sont pas vides
{

    // On check si l'utilisateur est inscrit dans la table user:
    $stmt = $bdd->prepare('SELECT * FROM user WHERE email = :email');
    $stmt->execute(array("email" => $_POST['email']));
    $row = $stmt->rowCount();

    // Si > à 0 alors l'utilisateur existe
    if ($row > 0) {
        $data = $stmt->fetch();
        // Si le mail est bon niveau format
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // Si le mot de passe est le bon
            if (password_verify($_POST['password'], $data['password'])) {
                // On crée la session et on redirige sur landing.php
                //on crée un booléen pour le boutton connexion déconnexion sur la navabar 
                $_SESSION['connexion'] = true;  // Utilisateur connecté
                $_SESSION['isAdmin'] = (int)$data['isAdmin']; // déclare isAdmin
                $_SESSION['pseudo'] = $data['pseudo']; // Stockage du pseudo
                $_SESSION['id'] = $data['id']; //Stokage de l'id
                $_SESSION['nom'] = $data['nom'];
                $_SESSION['prenom'] = $data['prenom'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['adresse'] = $data['adresse'];
                $_SESSION['code_postal'] = $data['code_postal'];
                $_SESSION['ville'] = $data['ville'];
                //$_SESSION['user'] = $data['token']; 

            
                header('Location: landing.php');
                die();
            } else {
                header('Location: index.php?login_err=password');
                die();
            }
        } else {
            header('Location: index.php?login_err=email');
            die();
        }
    } else {
        header('Location: index.php?login_err=already');
        die();
    }
} else {
    header('Location: index.php');
    die();
} // si le formulaire est envoyé sans aucune données




