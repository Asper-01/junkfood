<?php
require_once 'config.php';  // On inclut la Connexion à la Bdd
require_once 'fonction.php';  //Include des fonctions pour vérification isAdmin


$update = false;
$id = "";
$qty = "";
$id_product = "";
$user_id = "";


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

// 	echo '<pre>';
// 	var_dump($_SESSION);

// 	calculTotalPriceCart();
// }


// ***********************  Ajouter au panier  **************************

if (isset($_POST['pid'])) {
	$pid = (int)$_POST['pid'];   //on recupere la valeur postée (id produit)
	
	$quantity = (int)$_POST['qty'];

	if(!$quantity){
		$quantity = 1;
	}
	//$userId = $_POST['id'];

	$stmt = $bdd->prepare('SELECT id, prix FROM plats WHERE id=:id'); //on prépare une requete
	$stmt->execute(["id" => $pid]); //on attribue a query le resultat requete
	$query = $stmt->fetchAll()[0];


	if (empty($query)) {
		// Pas de produit correspondant
		// Implémenter une erreur (éventuellement)
	} else {
		// Produit trouvé en BDD
		// On ajoute le produit dans le panier
		//setProductInCart($query, $quantity);
		// On prépare la requête SQL
		// On selectionne nos champs de 'cart'


		//on check si un panier existe déjà pour cet user et ce produit
		$stmt = $bdd->prepare('SELECT * FROM cart WHERE user_id=:user_id and id_product=:id_product'); //on prépare une requete
		$stmt->execute(["id_product" => $pid, "user_id"=> $_SESSION["id"]]); //on attribue a query le resultat requete
		$cart_line = $stmt->fetch();


		// une ligne produit avec ce user existe et la quantité est superieur à 0
		if($cart_line && $cart_line['qty'] > 0)
		{
			//update la quantité sur cette ligne
			$new_quantity = $cart_line['qty'] + $quantity;
			$stmt = $bdd->prepare('UPDATE cart set qty=:new_quantity WHERE user_id=:user_id and id_product=:id_product');
			$stmt->execute(["id_product" => $pid, "user_id"=> $_SESSION["id"], 'new_quantity' => $new_quantity]); 
		} else {
			// ce produit n'est pas déjà dans le panier de cet user
			$stmt = $bdd->prepare('INSERT INTO cart (qty,id_product,user_id) VALUES(:quantity,:id_product,:user_id)');
			$stmt->execute(["id_product" => $pid, "user_id"=> $_SESSION["id"], 'quantity' => $quantity]); 
		}

	} header('location:/cart.php');
	return true;
	

	// ******************  CRUD EFFACER ********************
} else if (isset($_GET['delete'])) {
	$id = $_GET['delete'];
	// On efface l'entrée séléctionnée
	$stmt->execute(["id" => $pid]);
	$row = $stmt->fetch();

	$stmt = $bdd->prepare("DELETE * FROM cart WHERE id=:id");
	$stmt->execute(["id" => $id]);
	// On renvoie l'utilisateur à la page CRUD + message de confirmation
	header('location:cart.php');
	$_SESSION['response'] = "Champ effacé de la base de donnée !";
	$_SESSION['res_type'] = "danger";
}


//************************* AFFICHAGE DU PANIER *************************/

//Récupération de l'enssemble des produits en Bdd 
$sid = (int)$_SESSION['id'];
$stmt = $bdd->prepare('SELECT cart.*, plats.nom,plats.prix, plats.photo FROM cart
JOIN `plats` ON `plats`.`id`=`cart`.`id_product`
WHERE user_id=:id;');


$stmt->execute(["id" => $sid]);
$query = $stmt->fetchAll();

var_dump($_SESSION['id']);
$grand_total = 0;



require_once './view/cartView.php';
