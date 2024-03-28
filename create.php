<?php
require_once 'action.php';
require_once "header.php";
?>

<body>
    <div class="container-fluid">
        <div class="create-form">
            <form action=" action.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id; ?>">
                <div class="form-group">
                    <div class="form-group">
                        <h3 class="text-center text-info">Création fiche produit</h3>
                    </div>
                    <div class="form-group mb-3">
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
                        <?php } else { ?>
                            <input type="submit" name="add" class="btn btn-info btn-block" value="Ajouter la recette">
                        <?php } ?>
                    </div>
            </form>
        </div>
    </div>

    <?php
    $stmt = $bdd->prepare('SELECT * FROM plats'); //préparation de la Bdd pour fetch ttes les lignes du Crud.
    $stmt->execute();
    ?>

    <?php
    include "footer.php";
