<?php require_once "header.php"; ?>

<div class="container">
  <div class="form2">
    <div class="table-responsive mt-2" style="overflow-x: auto;">
      <table class="table table-bordered table-striped text-center">
        <thead>
          <tr>
            <th colspan="7">
              <h4 class="text-center text-info m-0">Produits dans votre panier</h4>
            </th>
          </tr>
          <tr>
            <th>Photo</th>
            <th>Produit</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Sous-total</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $totalCart = 0;
          $sousTotal = 0;

          foreach ($query as $row) :
            $sousTotal = number_format($row['prix'] * $row['qty']);
            $totalCart += $sousTotal;
          ?>
            <tr>
              <td><img src="<?= $row['photo'] ?>" width="50"></td>
              <td><?= $row['nom'] ?></td>
              <td><?= number_format($row['prix'], 2) ?> €</td>
              <td>
                <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width: 75px;">
              </td>
              <td><?= $sousTotal; ?> €</td>
              <td>
                <a href="/cart.php?delete=<?= $row['id']; ?>" class="badge badge-danger p-2" onclick="return confirm('Supprimer ces plats ?');">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td>
            </td>
            <td colspan="2"><b>Total panier</b></td>
            <td><?= $totalCart; ?>€</td>
              <td>
                <a href="checkout.php" class="badge badge-info  badge-custom" <?= $totalCart > 1 ? '' : 'disabled'; ?>>
                  <i class="far fa-credit-card"></i>&nbsp;&nbsp;Payer
                </a>
              </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

<?php include "footer.php"; ?>