<?php
require_once 'config.php';  // On inclut la Connexion à la Bdd
require_once 'fonction.php';  //Include des fonctions pour vérification isAdmin


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

function setProductInCart(array $query, int $qty)
{
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
	$userId = $_POST['id'];

	$stmt = $bdd->prepare('SELECT id, prix FROM plats WHERE id=:id'); //on prépare une requete
	$stmt->execute(["id" => $pid]); //on attribue a query le resultat requete
	$query = $stmt->fetchAll()[0];


	if (empty($query)) {
		// Pas de produit correspondant
		// Implémenter une erreur (éventuellement)
	} else {
		// Produit trouvé en BDD
		// On ajoute le produit dans le panier
		setProductInCart($query, $quantity);
		// On prépare la requête SQL
		$stmt = $bdd->prepare("INSERT INTO cart (qty,id_product,user_id)VALUES(:qty,:id_product,:user_id)");
		// On execute la requête SQL
		$stmt->execute(['qty' => $quantity, 'id_product' => $query['id'], 'user_id' => (int)$_SESSION['id']]);



		//var_dump($_SESSION['id']);
	}
	return true;
}


//************************* AFFICHAGE DU PANIER *************************/

//Récupération de l'enssemble des produits en Bdd 
$sid = (int)$_SESSION['id'];
$stmt = $bdd->prepare('SELECT cart.*, plats.nom,plats.prix, plats.photo FROM cart
JOIN `plats` ON `plats`.`id`=`cart`.`id_product`
WHERE user_id=:id;');
$stmt->execute(["id" => $sid]);
$query = $stmt->fetchAll();


var_dump('<pre>', $query, '</pre>');


$grand_total = 0;






require_once './view/cartView.php';
