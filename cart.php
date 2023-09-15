<?php
include 'config.php';  // On inclut la Connexion à la Bdd
include 'fonction.php';  //Include des fonctions pour vérification isAdmin






// Afficher les messages de mise a jour du CRUD
if (isset($_SESSION['response'])) {

	echo '<div class="message-container">';
    echo '<div class="alert alert-' . $_SESSION['res_type'] . '">';
    echo $_SESSION['response'];
    echo '</div>';
    unset($_SESSION['response']);
    unset($_SESSION['res_type']);
    echo '</div>';
}


// Initiatilaisation du panier dans la session
if (isset($_SESSION['cart']) === false) {
	$_SESSION['cart'] = [
		'products' => [],
		'total' => 0,
	];
}

// Fonction de calcul du prix total panier

function calculTotalPriceCart()
{
	$total = 0;
	foreach ($_SESSION['cart']['products'] as $product) {
		$total += intval($product['price']) * $product['quantity'];
	}
	$_SESSION['cart']['total'] = $total;
	return $total;
}

// function setProductInCart(array $query, int $qty) 
// {
// 	$productId = $query['id'];

// 	$_SESSION['cart']['products'][$productId] = [
// 		'idProduct' => $query['id'],
// 		'price' => $query['prix'],
// 		'quantity' => $qty,
// 	];

// 	calculTotalPriceCart();
// }


// ***********************  Ajouter au panier  **************************

if (isset($_POST['pid'])) {
	$pid = (int)$_POST['pid'];   //on recupere la valeur postée (id produit)
	$quantity = (int)$_POST['qty'];
	$userId = $_POST['id'];

	$stmt = $bdd->prepare('SELECT id, prix FROM plats WHERE id=:id'); //on prépare une requete
	$stmt->execute(["id" => $pid]); //on attribue a query le resultat requete
	$query = $stmt->fetchAll()[0];


	if (empty($query)) {
		// Pas de produit correspondant
		// Implémenter une erreur (éventuellement)
	} else {
		// setProductInCart($query, $quantity);


		//on check si un panier existe déjà pour cet user et ce produit
		$stmt = $bdd->prepare('SELECT cart.qty FROM cart WHERE user_id=:user_id and id_product=:id_product'); //on prépare une requete
		$stmt->execute(["id_product" => $pid, "user_id" => $_SESSION["id"]]); //on attribue a query le resultat requete
		$cart_line = $stmt->fetch();

		// une ligne produit avec ce user existe et la quantité est superieur à 0
		if ($cart_line) {
			//update la quantité sur cette ligne
			$new_quantity = $cart_line['qty'] + $quantity;
			$stmt = $bdd->prepare('UPDATE cart set qty=:new_quantity WHERE user_id=:user_id and id_product=:id_product');
			$stmt->execute(["id_product" => $pid, "user_id" => $_SESSION["id"], 'new_quantity' => $new_quantity]);
		} else {
			// ce produit n'est pas déjà dans le panier de cet user
			$stmt = $bdd->prepare('INSERT INTO cart (qty,id_product,user_id) VALUES(:quantity,:id_product,:user_id)');
			$stmt->execute(["id_product" => $pid, "user_id" => $_SESSION["id"], 'quantity' => $quantity]);
		}
	}

	header('location:/cart.php');
	return true;
}


// ******************  CRUD EFFACER UN CHAMP DE 'CART' ********************

if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	$_SESSION['response'] = "Produit retiré du panier";
	$_SESSION['res_type'] = "danger";
	$stmt = $bdd->prepare("DELETE FROM cart WHERE id=:id AND user_id=:user_id");
	$stmt->execute(["id" => $id, "user_id" => $_SESSION['id']]);
	// On renvoie l'utilisateur à la page Panier + message de confirmation
	header('location:cart.php');
}

// ********  CRUD EFFACER TOUS LES CHAMPS D'UN UTILISATEUR  'CART' ********

if (isset($_GET['clear'])) {
	$id = $_GET['clear'];
	$_SESSION['response'] = "Votre panier est vide !";
	$_SESSION['res_type'] = "danger";
	$stmt = $bdd->prepare("DELETE FROM cart WHERE user_id=:user_id");
	$stmt->execute(["user_id" => $_SESSION['id']]);
	var_dump($_SESSION['id']);
	// On renvoie l'utilisateur à la page Panier + message de confirmation
	header('location:cart.php');

}
//************************* AFFICHAGE DU PANIER *************************/

//Récupération de l'enssemble des produits en Bdd 
$sid = (int)$_SESSION['id'];
$stmt = $bdd->prepare('SELECT cart.*, plats.nom,plats.prix, plats.photo FROM cart
JOIN `plats` ON `plats`.`id`=`cart`.`id_product`
WHERE user_id=:id;');

$stmt->execute(["id" => $sid]);
$query = $stmt->fetchAll();

require_once './view/cartView.php';
