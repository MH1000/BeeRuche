<?php
// On démarre une session
session_start();

if ($_POST) {

    if (
        isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['latitude']) && !empty($_POST['latitude'])
        && isset($_POST['longitude']) && !empty($_POST['longitude'])
        && isset($_POST['poids']) && !empty($_POST['poids'])
        && isset($_POST['temperature']) && !empty($_POST['temperature'])
        && isset($_POST['humidite']) && !empty($_POST['humidite'])
    ) {

        // On inclut la connexion à la base
        require_once('config/connect.php');

        // On nettoie les données envoyées
        $nom = strip_tags($_POST['nom']);
        $latitude = strip_tags($_POST['latitude']);
        $longitude = strip_tags($_POST['longitude']);
        $poids = strip_tags($_POST['poids']);
        $temperature = strip_tags($_POST['temperature']);
        $humidite = strip_tags($_POST['humidite']);

        $sql = 'UPDATE `ruche` SET `nom`= :nom, `latitude`=:latitude, `longitude`=:longitude WHERE `id`=:id;';
        $sql = 'UPDATE `infos` SET `nom`= :nom, `poids`=:poids, `temperature`=:temperature, `humidite` = :humidite WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':latitude', $latidude, PDO::PARAM_STR);
        $query->bindValue(':longitude', $longitude, PDO::PARAM_STR);
        $query->bindValue(':poids', $poids, PDO::PARAM_STR);
        $query->bindValue(':temperature', $poids, PDO::PARAM_STR);
        $query->bindValue(':humidite', $poids, PDO::PARAM_STR);

        $query->execute();

        $_SESSION['message'] = "Ruche modifié";
        require_once('close.php');

        header('Location: ruche.php');
    } else {
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `ruche` WHERE `id` = :id;';
    $sql = 'SELECT * FROM `infos` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère la ruche
    $ruche = $query->fetch();

    // On vérifie si la ruche existe
    if (!$ruche) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ruche.php');
    }
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ruche.php');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une ruche</title>
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
                    <a class="nav-link active" href="ruche.php">Ruches</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="infos.php">Informations</a>
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

    <main class="container">
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
                <h1>Modifier une ruche</h1>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="nom">Nom de la Ruche</label>
                            <input type="text" id="nom" name="rom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="texte" id="latitude" name="latitude" class="form-control">

                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="texte" id="longitude" name="longitude" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="poinds">Poids</label>
                            <input type="texte" id="poids" name="poids" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="temperature">Température</label>
                            <input type="texte" id="poids" name="poids" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="humidite">Humidité</label>
                            <input type="texte" id="humidite" name="humidite" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update" class="btn btn-success">Envoyer</button>
                            <span class="float-right"> <a href="ruche.php" class="btn btn-primary">Retour</a> </span>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>
<?php

include 'vue/footer.php';
?>

</html>