<?php
include 'action.php';
include 'header.php';
require_once 'config.php';
?>

<?php
if (!userConnected()) { // Si c'est false
    header('location:index.php');
}
?>

