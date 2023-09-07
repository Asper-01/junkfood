<?php
include 'action.php';
include "header.php";
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
                        <img src="<?= $row['photo'] ?>" class="img-thumbnail" height="250">
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
                                        <input type="number" name = "qty" class="form-control pqty" value="<?= $row['product_qty'] ?>">
                                    </div>
                                </div>
                                <input type="hidden" name = "pid" class="pid" value="<?= $row['id'] ?>">
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

<script type="text/javascript">
    /*$(document).ready(function() {

        // Envoyer les détails des plats en Bdd:
        $(".addItemBtn").click(function(e) {
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var pid = $form.find(".pid").val();
            var pname = $form.find(".pname").val();
            var pprice = $form.find(".pprice").val();
            var pimage = $form.find(".pimage").val();
            var pcode = $form.find(".pcode").val();

            var pqty = $form.find(".pqty").val();

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: {
                    pid: pid,
                    pname: pname,
                    pprice: pprice,
                    pqty: pqty,
                    pimage: pimage,
                    pcode: pcode
                },
                success: function(response) {
                    $("#message").html(response);
                    window.scrollTo(0, 0);
                    load_cart_item_number();
                }
            });
        });

        // Load total no.of items added in the cart and display in the navbar
        load_cart_item_number();

        function load_cart_item_number() {
            $.ajax({
                url: 'action.php',
                method: 'get',
                data: {
                    cartItem: "cart_item"
                },
                success: function(response) {
                    $("#cart-item").html(response);
                }
            });
        }
    });*/
</script>



<?php
include "footer.php";
?>