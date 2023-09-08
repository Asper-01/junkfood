<?php
require_once 'headerAdmin.php';
require_once 'productUpdate.php';

if (!AdminConnected()) {
    header('location:../index.php');
}
?>

<body>

    <body class="d-flex flex-column">
        <div class="container-fluid">
            <div class="edition">
                <form action="productUpdate.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="form-group">
                        <?php
                        //préparation de la Bdd pour fetch ttes les lignes du Crud.

                        $stmt = $bdd->prepare("SELECT * FROM plats WHERE id=:id");
                        $stmt->execute(["id" => $id]);
                        $row = $stmt->fetch();
                        
                        $id = $row['id'];
                        $nom = $row['nom'];
                        $preparation = $row['preparation'];
                        $prix = $row['prix'];
                        $photo = $row['photo'];
                        $categorie = $row['categorie'];

                        ?>
                        <div class="form-group">
                            <h3 class="text-center text-info">Mise à jour produit</h3>
                            <div class="form-group mb-3">

                                <?php $stmt->fetch(); { ?>

                                    <div class="images text-center">
                                        <img src="/<?= $_GET['image']; ?>" width="400" class="img-thumbnail rounded">
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

                                <input type="submit" name="update" class="btn btn-success btn-block" value="Mettre à jour">


                                <a href="product.php" class="btn btn-danger btn-block">Retour</a>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
    </body>

    <?php
    require_once "../footer.php";
