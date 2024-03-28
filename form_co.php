<?php
//Affichage du header et Co à la Bdd
require_once "config.php";
require_once "header.php";
?>

<body>


   <div class="container-fluid">
      <div class="login-form">
         <?php //Formulaire de connexion si erreurs:
         if (isset($_GET['login_err'])) {
            $err = htmlspecialchars($_GET['login_err']);

            switch ($err) {
               case 'password':
         ?>
                  <div class="alert alert-danger">
                     <strong>ErFreur</strong> mot de passe incorrect
                  </div>
               <?php
                  break;
               case 'email':
               ?>
                  <div class="alert alert-danger">
                     <strong>Erreur</strong> email incorrect
                  </div>
               <?php
                  break;
               case 'already':
               ?>
                  <div class="alert alert-danger">
                     <strong>Erreur</strong> compte non existant
                  </div>
         <?php
                  break;
            }
         }
         //Si aucune erreur détectée on peut submit le formulaire:
         ?>

         <form action="connexion.php" method="post">
            <h3 class="text-center text-info">Me connecter</h3>
            <div class="form-group">
               <input type="email" name="email" class="form-control" placeholder="Email" required="required" autocomplete="off">
            </div>
            <div class="form-group">
               <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary btn-block">Connexion</button>
               <a href="inscription.php" class="btn btn-info btn-block addItemBtn">Inscription</a>
            </div>
         </form>
      </div>


      <?php require_once "footer.php"; ?>