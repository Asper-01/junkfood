<?php
include 'config.php';  // On inclut la Connexion à la Bdd
include 'fonction.php';  //Include des fonctions pour vérification isAdmin

// Initiatilaisation du panier dans la session
if (isset($_SESSION['cart']) === false) {
    $_SESSION['cart'] = [
        'products' => [],
        'total' => 0,
    ];
}

function calculTotalPriceCart() {
    $total = 0;
    foreach ($_SESSION['cart']['products'] as $product) {
        $total += intval($product['price']) * $product['quantity'];
    }
    $_SESSION['cart']['total'] = $total;
    return $total;
}

function setProductInCart(array $query, int $qty) {
    $productId = $query['id'];

    $_SESSION['cart']['products'][$productId] = [
        'idProduct' => $query['id'],
        'price' => $query['prix'],
        'quantity' => $qty,
    ];

    calculTotalPriceCart();
}



// ***********************  Ajouter au panier  **************************

	if (isset($_POST['pid'])) {
		$pid = (int)$_POST['pid'];   //on recupere la valeur postée (id produit)
		$quantity = (int)$_POST['qty'];


        $stmt = $bdd->prepare('SELECT id, prix FROM plats WHERE id=:id'); //on prépare une requete
        $stmt->execute(["id" => $pid]); //on attribue a quert le resultat requete
        $query = $stmt->fetchAll()[0];

        if (empty($query)) {
            // Pas de produit correspondant
            // Implémenter une erreur (éventuellement)
        } else {
            // Produit trouvé en BDD
            // On ajoute le produit dans le panier
            setProductInCart($query, $quantity);

            // Sauvegard en BDD, avec une function INSERT
        }

        var_dump('<pre>', $_SESSION['cart']);exit;


		$total_price = $pprix * $pqty;
		$grand_total = $total_price;
  
		$stmt = $bdd->prepare('INSERT INTO cart  WHERE id=:id');
		$stmt->execute(['nom' => $pnom, "prix" => $pprix, "photo" => $pphoto, "qty" => $pqty, "total_price" => $total_price]);
	
	
		  echo '<div class="alert alert-success alert-dismissible mt-2">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Item added to your cart!</strong>
						  </div>';
		} else {
		  echo '<div class="alert alert-danger alert-dismissible mt-2">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Item already added to your cart!</strong>
						  </div>';
		}
	  
  	// Si les produits sont indispos

	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
		$stmt = $bdd->prepare('SELECT * FROM cart');
		$stmt->execute();
		$row = $stmt->fetch();
  
	  }
  
	  // Retirer un produit du panier
	  if (isset($_GET['remove'])) {
		$id = $_GET['remove'];
  
		$stmt = $bdd->prepare('DELETE FROM cart WHERE id=?');
		$stmt->execute(["id" => $id]);
		$stmt->execute();
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'Produit retiré du panier';
		header('location:panier.php');
	  }
  
	  // Vider le panier entier
	  if (isset($_GET['clear'])) {
		$stmt = $bdd->prepare('DELETE FROM cart');
		$stmt->execute();
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'Panier entièrement vidé';
		header('location:panier.php');
	  }
  
	  // Calculer le prix total du panier
	  if (isset($_POST['qty'])) {
		$qty = $_POST['qty'];
		$pid = $_POST['pid'];
		$pprix = $_POST['pprix'];
  
		$tprice = $qty * $pprice;
  
		$stmt = $bdd->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
		$stmt->execute(["qty" => $qty, "pprix" => $pprix, "pid => $pid" ]);
		$row = $stmt->fetch();

	  }
  
	  // Faire le checkout et sauvegarder les infos dans la table orders:
	  if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
		$nom = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$products = $_POST['products'];
		$grand_total = $_POST['grand_total'];
		$address = $_POST['address'];
		$pmode = $_POST['pmode'];
  
		$data = '';
  
		$stmt = $conn->bdd('INSERT INTO orders (name,email,phone,address,pmode,products,amount_paid)VALUES(?,?,?,?,?,?,?)');
		$stmt->bind_param('sssssss',$name,$email,$phone,$address,$pmode,$products,$grand_total);
		$stmt->execute();
		$stmt2 = $bdd->prepare('DELETE FROM cart');
		$stmt2->execute();
		$data .= '<div class="text-center">
								  <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
								  <h2 class="text-success">Your Order Placed Successfully!</h2>
								  <h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
								  <h4>Your Name : ' . $name . '</h4>
								  <h4>Your E-mail : ' . $email . '</h4>
								  <h4>Your Phone : ' . $phone . '</h4>
								  <h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
								  <h4>Payment Mode : ' . $pmode . '</h4>
							</div>';
		echo $data;
	  }
