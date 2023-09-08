<?php
require_once '../fonction.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf8mb4_general_ci">
    <meta name="Asper" content="Navbar-header">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Junk Food !</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
    <header> <!-- Navbar Bootstrap modifiée Transparente - Collapse set sur "expand-sm"   -->
        <nav class="navbar navbar-expand-sm navbar-dark">
            <a class="navbar-brand" href="../index.php">Junk Food</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                   
                    <?php if (userConnected()) { ?>
                    <?php } ?>
                    <?php //var_dump($_SESSION);
                    if (AdminConnected())
                    //Fonction d'affichage du lien vers le CRUD (uniquement si l'utilisateur est Admin 1=Admin 0=User)+++++++++++++++++++++++++++++++   
                    { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="product.php">Gestion produits</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="userAdmin.php">Gestion Users<span class="sr-only">(current)</span></a>
                        </li>
                    <?php } ?>
                </ul>
                <ul>
                    <?php if (userConnected()) {
                        //Fonction PhP pour afficher le boutton "Mon Compte" si l'utilisateur est connecté: $_SESSION['connexion'] = true; si le mdp et le log sont corrects dans connection.php 
                    ?>
                        <div class="btnConnect">
                            <div class="btnCo1">
                                <li class="d-flex"><a href="../monCompte.php" class="btn btn-success">Mon compte</a></li>
                            </div>
                            <div class="btnCo2">
                                <li class="d-flex"><a href="../deconnexion.php" class="btn btn-danger">deconnexion</a></li>
                            </div>
                        </div>
                    <?php } else { //Si non connecté on affiche "Connexion"
                    ?>
                        <li class="d-flex"><a href="../form_co.php" class="btn btn-success">Connexion</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>


