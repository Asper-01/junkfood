<?php
require_once '../action.user.php';
require_once 'headerAdmin.php';
if (!AdminConnected()) {
    header('location:../index.php');
}
?>

<body>
    <div class="container-fluid">
        <div class="form2">
            <?php
            $stmt = $bdd->prepare('SELECT * FROM user');
            //préparation de la Bdd pour fetch ttes les lignes de la table user.
            $stmt->execute();
            ?>
            <h3 class="text-center text-info">Tous les comptes</h3>
            <div class="table">
                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>pseudo</th>
                            <th>email</th>
                            <th>isAdmin</th>
                            <th>Intéragir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch()) { ?>
                            <tr>
                                <td><?= $row['pseudo']; ?></td>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['isAdmin']; ?></td>
                                <td>
                                    <a href="../action.user.php?delete=<?= $row['pseudo']; ?>" class="badge badge-danger p-2" onclick="return confirm('Voulez vous effacer cette entrée?');">Effacer</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>