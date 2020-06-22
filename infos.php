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
                    <h1>Informations des ruches</h1>
                </div>

                <table id="example" class="table table-striped ">

                    <thead>
                        <tr>
                            <th>Ruche</th>
                            <th>Date</th>
                            <th>Poids</th>
                            <th>Température</th>
                            <th>Humidité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $infoss) {
                        ?>
                            <tr>
                                <td><?= $infoss['nom'] ?></td>
                                <td><?= $infoss['date'] ?></td>
                                <td><?= $infoss['poids'] ?></td>
                                <td><?= $infoss['temperature'] ?></td>
                                <td><?= $infoss['humidite'] ?></td>
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