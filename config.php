<?php
	//Connexion à la Bdd en localhost via l'objet PDO
	session_start();

	try {
		$bdd = new PDO('mysql:host=localhost;dbname=crud_db;charset=utf8mb4', 'root', '');
	} catch (PDOException $e) {
		die('Erreur : ' . $e->getMessage());
	}