<?php 
session_start();

// Destruction de la session
session_destroy();


// Retour automatique à la page d'accueil
header('Location: index.php');

?>