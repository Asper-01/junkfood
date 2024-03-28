<?php
require_once 'action.php';
require_once 'header.php';
require_once 'config.php';
?>

<?php
if (!userConnected()) { // Si c'est false
    header('location:index.php');
}
?>

