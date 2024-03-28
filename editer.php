<?php
require_once 'action.php';
require_once "header.php";

if (!AdminConnected()) {
    header('location:index.php');
}
?>


<body>
   
        <div class="container-fluid">
            <div class="edition">
                <form action="action.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="form-group">
                        <div class="form-group">
                            <h3 class="text-center text-info">Mise à jour produit</h3>
                        </div>
                        <div class="form-group mb-3">
                            <div class="images text-center">
                                <img src="<?= $row['photo']; ?>" width="200" class="rounded">
                            </div>
                            <br>
                            <input type="username" name="nom" value="<?= $nom; ?>" class="form-control" placeholder="Enter nom" required>
                            <input type="text" name="preparation" value="<?= $preparation; ?>" class="form-control" placeholder="Décrire la recette" required>
                            <input type="text" name="prix" value="<?= $prix; ?>" class="form-control" placeholder="Prix de vente TTC" required>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="oldimage" value="<?= $photo; ?>">
                            <input type="file" name="image" class="custom-file">
                        </div>
                        <div class="form-group text-center">
                            <input type="radio" name="categorie" value="1" <?php if ($categorie == "1") { ?>checked<?php } ?>>
                            <label for="entrée">Entrée</label>
                            <input type="radio" name="categorie" value="2" <?php if ($categorie == "2") { ?>checked<?php } ?>>
                            <label for="plat">Plat</label>
                            <input type="radio" name="categorie" value="3" <?php if ($categorie == "3") { ?>checked<?php } ?>>
                            <label for="dessert">Dessert</label>
                        </div>

                        <div class="form-group">
                            <?php if ($update == true) { ?>
                                <input type="submit" name="update" class="btn btn-success btn-block" value="Mettre à jour">
                            <?php } ?>

                            <a href="recettes.php" class="btn btn-danger btn-block">Retour</a>
                        </div>
                </form>
            </div>
    

    <?php
    include "footer.php";
