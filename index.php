<?php
require_once 'action.php';
require_once "header.php";
?>

<!-- Affichage des plats -->
<div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
        <?php
        $stmt = $bdd->prepare('SELECT * FROM plats');
        $stmt->execute();
        ?>
        <?php while ($row = $stmt->fetch()) { ?>

            <div class="col-sm-6 col-md-4 col-lg-3 mb-2 p-4">
                <div class="card-deck">
                    <div class="form3 p-2 border-secondary mb-2">
                        <img src="<?= $row['photo'] ?>" class="img-thumbnail " height="250">
                        <div class="card-body p-1">
                            <h4 class="card-title text-center text-info"><?= $row['nom'] ?></h4>
                            <h5 class="card-text text-center text-danger"></i>&nbsp;&nbsp;<?= number_format($row['prix'], 2) ?> €</h5>

                        </div>
                        <div class="card-footer p-1">
                            <form action="/cart.php" class="form-submit" method="post">
                                <div class="row p-2">
                                    <div class="col-md-6 py-1 pl-4">
                                        <b>Quantitée : </b>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="qty" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="pid" class="pid" value="<?= $row['id'] ?>">
                                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Ajouter au panier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Fin de l'affichage carte des plats -->

<!-- scripts ajouts -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>


<?php
require_once "footer.php";
