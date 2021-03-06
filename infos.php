<?php

// On démarre une session
session_start();

// On détermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}

// On se connecte à là base de données
require_once('config/connect.php');

$sql = 'SELECT * FROM `infos`';

// On prépare la requête
$query = $db->prepare($sql);

// On détermine le nombre total de ruches
$sql = 'SELECT * FROM `infos`';

$res = $db->query('select count(*) as nb from infos');
$data = $res->fetch();
$nb = $data['nb'];


// On exécute
$query->execute();

// On récupère les valeurs dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);


require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beeruche</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="">Company</a>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto mt-4 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ruche.php">Ruches <span class="badge badge-danger"><?php echo $nb; ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="infos.php">Informations</a>
                </li>
            </ul>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?action=logout">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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