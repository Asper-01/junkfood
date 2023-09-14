<?php
require_once './headerAdmin.php';
require_once '../action.php';  // solution temporaire pour résoudre les variables non définies

if (!AdminConnected()) {
    header('location:../index.php');
}
?>



<?php
// Ligne pour afficher les messages de mise a jour du CRUD
if (isset($_SESSION['response'])) {
    echo '<div class="create-form"> <div class="alert alert-' . $_SESSION['res_type'] . '"></div>';
    echo $_SESSION['response'];
    echo '</div>';
    unset($_SESSION['response']);
    unset($_SESSION['res_type']);
}
?>


<body>
    <body class="d-flex flex-column">
        <div class="container-fluid">
            <div class="create-form">
                <form action="productCreate.php" method="post" enctype="multipart/form-data">
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

                                <input type="submit" name="add" class="btn btn-info btn-block" value="Ajouter la recette">
                                <a href="product.php" class="btn btn-danger btn-block">Retour aux produits</a>
                        </div>
                </form>
            </div>
        </div>

        <?php
        $stmt = $bdd->prepare('SELECT * FROM plats'); //préparation de la Bdd pour fetch ttes les lignes du Crud.
        $stmt->execute();
        ?>

        <?php
        include "../footer.php";
