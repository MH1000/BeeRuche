<?php
// On démarre une session
session_start();

// Est-ce que l'id existe et n'est pas vide dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `ruche` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();

    // On récupère la ruche
    $ruche = $query->fetch();

    // On vérifie si le produit existe
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
    <title>Détails de la ruche</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <p>ID : <?= $ruche['id'] ?></p>
                <p>Lattitude : <?= $ruche['lattitude'] ?></p>
                <p>Longitude : <?= $produit['longtitude'] ?></p>
                <p><a href="ruche.php">Retour</a> <a href="edit.php?id=<?= $ruche['id'] ?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>

</html>