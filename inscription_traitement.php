<?php
require_once 'config.php'; // On inclut la connexion à la bdd


$regex = "#^[a-z0-9][a-z0-9]*[-]?[a-z0-9]*[a-z0-9]+$#";

// Si les variables existent et qu'elles ne sont pas vides
if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype'])) {
    // Patch XSS
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);


    // On vérifie si l'utilisateur existe déjà
    $check = $bdd->prepare('SELECT pseudo, email, password FROM user WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();

    $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule

    // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
    if ($row == 0) {
        if (strlen($pseudo) <= 20) { // On verifie que la longueur du pseudo <= 20
            if (strlen($pseudo) >= 3) { // On verifie que la longueur du pseudo >= 3
                if (!empty($pseudo)) {
                    if  (!preg_match("#^[a-z0-9][a-z0-9]*[-]?[a-z0-9]*[a-z0-9]$#i", "{($pseudo)}"))  {
                        if (strlen($email) <= 45) { // On verifie que la longueur du mail <= 45
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // Si l'email est de la bonne forme
                                if ($password === $password_retype) { // si les deux mdp saisis sont bon

                                    // On hash le mot de passe avec Bcrypt, via un coût de 12
                                    $cost = ['cost' => 12];
                                    $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                                    // On stock l'adresse IP:
                                    $ip = $_SERVER['REMOTE_ADDR'];

                                    // On insère dans la Bdd:
                                    $insert = $bdd->prepare('INSERT INTO user(pseudo, email, password, ip, token) VALUES(:pseudo, :email, :password, :ip, :token)');
                                    $insert->execute(array(
                                        'pseudo' => $pseudo,
                                        'email' => $email,
                                        'password' => $password,
                                        'ip' => $ip,
                                        'token' => bin2hex(openssl_random_pseudo_bytes(64))
                                    ));
                                    // On redirige avec le message de succès
                                    header('Location:inscription.php?reg_err=success');
                                    die();
                                } else {
                                    header('Location: inscription.php?reg_err=password');
                                    die();
                                }
                            } else {
                                header('Location: inscription.php?reg_err=email');
                                die();
                            }
                        } else {
                            header('Location: inscription.php?reg_err=email_length');
                            die();
                        }
                    } else {
                        header('Location: inscription.php?reg_err=pseudo_preg');
                        die();
                    }
                }
            } else {
                header('Location: inscription.php?reg_err=pseudo_min_length');
                die();
            }
        } else {
            header('Location: inscription.php?reg_err=pseudo_length');
            die();
        }
    } else {
        header('Location: inscription.php?reg_err=already');
        die();
    }
}


