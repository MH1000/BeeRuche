<?php
include 'vue/header.php';

?>

<body>

    <div class="container ptb-10 ">
        <div class="row">
            <section class="col-12">
                <?php
                if (!empty($_SESSION['erreur'])) {
                    echo '<div class="alert alert-danger" role="alert">
                                ' . $_SESSION['erreur'] . '
                            </div>';
                    $_SESSION['erreur'] = "";
                }
                ?>
                <?php
                if (!empty($_SESSION['message'])) {
                    echo '<div class="alert alert-success" role="alert">
                                ' . $_SESSION['message'] . '
                            </div>';
                    $_SESSION['message'] = "";
                }
                ?>
                <div class="pt-30">
                    <a href="add.php" class="btn btn-success">Ajouter une ruche</a>
                </div>

                <table id="example" class="table table-striped ">

                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Lattitude</th>
                            <th>Longitude</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $ruchess) {
                        ?>
                            <tr>
                                <td><?= $ruchess['nom'] ?></td>
                                <td><?= $ruchess['latitude'] ?></td>
                                <td><?= $ruchess['longitude'] ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="edit.php?id=<?= $ruchess['id'] ?>">Modifier</a>
                                    <a onclick="return confirm('Ëtes vous de supprimer ?')" class="btn btn-danger btn-sm" href="delete.php?id=<?= $ruchess['id'] ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </section>
        </div>
    </div>
</body>

<?php
include 'vue/footer.php';

?>

</html>