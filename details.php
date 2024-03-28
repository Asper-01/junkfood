<?php
require_once 'action.php';
require_once 'header.php';
?>

<body>

  <div class="d-flex flex-column">
    <div class="container-fluid">
      <div class="details">
        <h2 class="bg p-1 rounded text-center text-dark">ID : <?= $vid; ?></h2>
        <div class="p-2 text-center ">
          <img src="<?= $vphoto; ?>" width="400" class="img-thumbnail">
        </div>
        <h4 class="text-dark text-center">nom : <?= $vnom; ?></h4>
        <h4 class="text-dark text-center">categorie : <?= $vcategorie; ?></h4>
        <h4 class="text-dark text-center">preparation : <?= $vpreparation; ?></h4>
        <h4 class="text-dark text-center">Prix : <?= $vprix; ?></h4>
        <a href="/admin/product.php" class="btn btn-danger btn-block">Retour aux produits</a>
      </div>
    </div>
  </div>


  <?php include "footer.php"; ?>