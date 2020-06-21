<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset(isset($_POST['ruche']) && !empty($_POST['ruche'])
    && isset($_POST['latitude']) && !empty($_POST['lattitude'])
    && isset($_POST['longitude']) && !empty($_POST['longitude']))
{
        // On inclut la connexion à la base
        require_once('connect.php');

        // On nettoie les données envoyées
        $id = strip_tags($_POST['id']);
        $ruche = strip_tags($_POST['ruche']);
        $lattitude = strip_tags($_POST['latitude']);
        $longitude = strip_tags($_POST['longitude']);

        $sql = 'UPDATE `ruche` SET `ruche`=:ruche, `latitude`=:latitude, `longitude`=:longitude WHERE `id`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':ruche', $ruche, PDO::PARAM_STR);
        $query->bindValue(':latitude', $lattitude, PDO::PARAM_STR);
        $query->bindValue(':longitude', $longitude, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "ruche modifié";
        require_once('close.php');

        header('Location: ruche.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
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

    // On récupère le ruche
    $ruche = $query->fetch();

    // On vérifie si le ruche existe
    if(!$ruche){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ruche.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ruche.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un ruche</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Modifier Une Ruche</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="ruche">Nom Ruche</label>
                        <input type="text" id="ruche" name="ruche" class="form-control" value="<?= $ruche['ruche']?>">
                    </div>
                    <div class="form-group">
                        <label for="latitude">Lattitude</label>
                        <input type="number" id="latitude" name="latitude" class="form-control" value="<?= $ruche['latitude']?>">

                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="number" id="longitude" name="longitude" class="form-control" value="<?= $ruche['longitude']?>">
                    </div>
                    <input type="hidden" value="<?= $ruche['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>