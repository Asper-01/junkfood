<?php
require_once './headerAdmin.php';
require_once '../action.php';  // solution temporaire pour résoudre les variables non définies
require_once '../fonction.php'
?>
<?php if (!AdminConnected()) {
    header('location:../index.php');
} 


// Ligne pour afficher les messages de mise a jour du CRUD
if (isset($_SESSION['response'])) {
    echo '<div class="alert alert-' . $_SESSION['res_type'] . '">';
    echo $_SESSION['response'];
    echo '</div>';
    unset($_SESSION['response']);
    unset($_SESSION['res_type']);
}

?>

<body>
    <div class="d-flex flex-column">
        <div class="container-fluid">
        <form action="product.php" method="post" enctype="multipart/form-data">
            <div class="form2">
                <?php
                //préparation de la Bdd pour fetch ttes les lignes du Crud.
                $stmt = $bdd->prepare('SELECT * FROM plats');
                $stmt->execute();
                ?>
                <h3 class="text-center text-info">Gestion des Produits</h3>

                <div class=btn>
                    <div class="text-center">
                        <a href="./productCreate.php" class="btn btn-info">Ajouter un plat</a>
                    </div>
                    <div class="table">
                        <table class="table table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Visuel</th>
                                    <th>Nom</th>
                                    <th>Categorie</th>
                                    <th>Prix</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $stmt->fetch()) { ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><img src="/<?= $row['photo']; ?>" width="50" class="rounded"></td>
                                        <td><?= $row['nom']; ?></td>
                                        <td><?= $row['categorie']; ?></td>
                                        <td><?= $row['prix']; ?></td>
                                        <td>
                                            <a href="productRead.php?details=<?= $row['id']; ?>" class="badge badge-info p-2">Détails</a>
                                            <a href="../admin/product.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Voulez vous effacer cette entrée?');">Effacer</a>
                                            <a href="productUpdate.php?edit=<?= $row['id']; ?>" class="badge badge-success p-2">Editer</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <?php
    include "../footer.php";
