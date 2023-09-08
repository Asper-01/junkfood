<?php
require_once './headerAdmin.php';
require_once '../action.php';  // solution temporaire pour résoudre les variables non définies


if (!AdminConnected()) {
    header('location:../index.php');
}


// Ligne pour afficher les messages de mise a jour du CRUD
if (isset($_SESSION['response'])) {
    echo '<div class="alert alert-' . $_SESSION['res_type'] . '">';
    echo $_SESSION['response'];
    echo '</div>';
    unset($_SESSION['response']);
    unset($_SESSION['res_type']);
}
?>