<?php
include 'action.user.php';
include 'header.php';
require_once 'config.php';
?>

<?php
if (!userConnected()) { // Si c'est false
    header('location:index.php');
}
?>

<body>

    <body class="d-flex flex-column">
        <div class="container-fluid">
            <div class="form3 p-2 border-secondary mb-2">
                
                    
                    <h3 class="text-center text-info">Infos de profil</h3> 
                    <ul>
                        <li>Prénom : <b><?= $_SESSION['prenom'] ?></b></li>
                        <li>Nom : <b><?= $_SESSION['nom'] ?></b></li>
                        <li>Pseudo : <b><?= $_SESSION['pseudo'] ?></b></li>
                        <li>Email : <b><?= $_SESSION['email'] ?></b></li>
                        <li>Statut : <b><?= ($_SESSION['isAdmin'] == '0') ? 'Client' : 'Admin' ?></b></li>
                    </ul>


                    <h3 class="text-center text-info">Adresse de livraison</h3>
                    <p>
                        <b><?= $_SESSION['nom'] ?> <?= $_SESSION['prenom'] ?></b><br/>
                        <?= $_SESSION['adresse'] ?><br />
                        <?= $_SESSION['code_postal'] ?> <?= $_SESSION['ville'] ?>
                    </p>
                    <a href="index.php" class="btn btn-danger btn-block">Retour acceuil</a>
                    <div class="form2">
                        <?php
                        $stmt = $bdd->prepare("SELECT * FROM user WHERE id = :id");
                        $stmt->bindParam(':id', $_SESSION['id']);
                        $stmt->execute();
                        $row = $stmt->rowCount();
                        ?>
                        <h3 class="text-center text-info">Modifier mes informations</h3>

                        <div class="table">
                            <table class="table table-hover" id="data">
                                <thead>

                                </thead>
                                <tbody>
                                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td><?= $row['pseudo']; ?></td>
                                            <td>
                                                <a href="editerMonCompte.php?edit=<?= $row['id']; ?>" class="badge badge-success p-2">Editer mes informations</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                        </div>





                    </div>








                    <?php
                    include "footer.php";
                    ?>