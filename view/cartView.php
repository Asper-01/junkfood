<?php
require_once "header.php";
?>

<div class="container-fluid">
  <div class="form2">
      <div class="table-responsive mt-2">
        <table class="table table-bordered table-striped text-center">
          <thead>
            <tr>
              <td colspan="7">
                <h4 class="text-center text-info m-0">Produits dans votre panier</h4>
              </td>
            </tr>
            <tr>
              <th>ID</th>
              <th>Photo</th>
              <th>Produit</th>
              <th>Prix unitaire</th>
              <th>Quantitée</th>
              <th>sous total</th>
              <th>
                <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Vider votre panier?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
              </th>
            </tr>


         <?php
          $totalCart = 0;
          $sousTotal =0;

          ?>


          <?php
          //On boucle pour afficher la $query
          foreach ($query as $row):

            $sousTotal = number_format($row['prix'] * $row['qty']);
            $totalCart += $sousTotal;

          ?>

            <tr>
              <td><?= $row['id'] ?></td>
              <input type="hidden" class="pid" value="<?= $row['id'] ?>">
              <td><img src="<?= $row['photo'] ?>" width="50"></td>
              <td><?= $row['nom'] ?></td>
              <td>
                <h5 class="card-text text-center text-danger"></i>&nbsp;&nbsp;<?= number_format($row['prix'], 2) ?> €</h5>
              </td>
              <input type="hidden" class="pprix" value="<?= $row['prix'] ?>">
              <td>
                <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
              </td>
              <td><i class="fas"></i>&nbsp;&nbsp;<?= $sousTotal; ?> €</td>
              <td> <?php
              echo
              $_SESSION['cart']['total'];
              ?>
                </td> 
              <td>
                <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
              </td>
            </tr>

          <?php
          endforeach; ?>

          <tr>
            <td colspan="3">
              <a href="index.php" class="btn btn-success"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Continue
                Shopping</a>
            </td>
            <td colspan="2"><b>Total panier</b></td>
            <td><i class="fas"></i>&nbsp;&nbsp;<?=  $totalCart; ?>€</td>
            <td>
              <a href="checkout.php" class="btn btn-info <?= $totalCart > 1 ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
            </td>

        </table>
      </div>
  </div>
</div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<script type="text/javascript">
  $(document).ready(function() {

    // Change the item quantity
    $(".itemQty").on('change', function() {
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprix = $el.find(".pprix").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);
      $.ajax({
        url: 'action.php',
        method: 'post',
        cache: false,
        data: {
          qty: qty,
          pid: pid,
          pprix: pprix
        },
        success: function(response) {
          console.log(response);
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
  });
</script>



<?php
include "footer.php";
