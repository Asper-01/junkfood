<?php
include 'action.user.php';
include "header.php";
?>

<body>

    <body class="d-flex flex-column">
        <div class="container-fluid">
            <div class="edition">
                <form action="action.user.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div class="form-group">
                        <div class="form-group">
                            <h3 class="text-center text-info">Mes informations</h3>

                            <input type="username" name="pseudo" value="<?= $pseudo; ?>" class="form-control" placeholder="Entrer votre pseudo" required>

                            <input type="family-name" name="nom" value="<?= $nom; ?>" class="form-control" placeholder="Entrer votre nom" required>

                            <input type="given-name" name="prenom" value="<?= $prenom; ?>" class="form-control" placeholder="Entrer prenom" required>

                            <input type="email" name="email" value="<?= $email; ?>" class="form-control" placeholder="Entrer email" required>

                            <input type="street-address" name="adresse" value="<?= $adresse; ?>" class="form-control" placeholder="Entrer adresse" required>

                            <input type="postal-code" name="code_postal" value="<?= $code_postal; ?>" class="form-control" placeholder="Entrer code postal" required>

                            <input type="text" name="ville" value="<?= $ville; ?>" class="form-control" placeholder="Entrer ville" required>
                        </div>


                        <div class="form-group">
                            <?php if ($update == true) { ?>
                                <input type="submit" name="update" class="btn btn-success btn-block" value="Mettre à jour mes Informations">

                            <?php } ?>
                            <a href="monCompte.php" class="btn btn-danger btn-block">Retour</a>
                        </div>
                </form>
            </div>
    </body>

    <?php
    include "footer.php";
