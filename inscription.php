<?php
require_once 'config.php';
require_once 'header.php';
?>

<body>

    <div class="d-flex flex-column">
        <div class="container-fluid">
            <div class="inscription-form">
                <?php //Les messages d'erreur sont générés en HTML et les classes d'alerte du framework Bootstrap CSS sont utilisées pour les mettre en forme
                if (isset($_GET['reg_err'])) {
                    $err = $_GET['reg_err'];
                    switch ($err) {
                        case 'success':
                            // Message de succès
                ?>
                            <div class="alert alert-success text-center">
                                <strong>Félicitations !</strong> Votre compte a été créé !
                            </div>
                        <?php
                            break;
                        case 'password':
                            // Erreur de mot de passe
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Les mots de passe ne correspondent pas.
                            </div>
                        <?php
                            break;
                        case 'email':
                            // Erreur d'e-mail non valide
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> L'adresse e-mail n'est pas valide.
                            </div>
                        <?php
                            break;
                        case 'email_length':
                            // Erreur de longueur de l'e-mail
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> L'adresse e-mail est trop longue.
                            </div>
                        <?php
                            break;
                        case 'pseudo_preg':
                            // Erreur de format de pseudo
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Le pseudo ne doit contenir que des caractères alphanumériques (A-Z, a-z, 0-9).
                            </div>
                        <?php
                            break;
                        case 'pseudo_length':
                            // Erreur de longueur de pseudo
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Le pseudo doit contenir au maximum 15 caractères.
                            </div>
                        <?php
                            break;
                        case 'pseudo_min_length':
                            // Erreur de longueur minimale de pseudo
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Le pseudo doit contenir au moins 3 caractères.
                            </div>
                        <?php
                            break;
                        case 'already':
                            // Erreur de compte déjà existant
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Un compte avec cette adresse e-mail existe déjà.
                            </div>
                <?php
                            break;
                            // Ajoutez d'autres cas d'erreur si nécessaire
                    }
                }
                ?>
                <form action="inscription_traitement.php" method="post">
                    <h3 class="text-center text-info">Inscription</h3><br>
                    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="required" autocomplete="off"><br>

                    <div class="row">
                        <div class="col">
                            <input type="text" name="nom" class="form-control" placeholder="Nom" required="required" autocomplete="off"><br>
                        </div>
                        <div class="col">
                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required="required" autocomplete="off"><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off"><br>
                        </div>
                        <div class="col">
                            <input type="text" name="adresse" class="form-control" placeholder="Adresse" required="required" autocomplete="off"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="text" name="code_postal" class="form-control" placeholder="Code postal" required="required" autocomplete="off"><br>
                        </div>
                        <div class="col">
                            <input type="text" name="ville" class="form-control" placeholder="Ville" required="required" autocomplete="off"><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                        </div>
                        <div class="col">
                            <input type="password" name="password_retype" class="form-control" placeholder="Re-tapez mot de passe" required="required" autocomplete="off"><br>
                        </div>
                    </div>
                    <div class="raw2">
                        <div class="col2 d-flex">
                            <button type="submit" class="btn btn-info">Inscription</button>
                        </div>
                        <div class="col2 d-flex">
                            <a href="index.php" class="btn btn-danger">Retour</a>
                        </div>
                    </div>
                </form>
            </div>



            <?php include "footer.php"; ?>