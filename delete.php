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
    $ruches = $query->fetch();

    // On vérifie si la ruche existe
    if (!$ruchess) {
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ruche.php');
        die();
    }

    $sql = 'DELETE FROM `ruche` WHERE `id` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Ruche supprimé";
    header('Location: ruche.php');
} else {
    $_SESSION['erreur'] = "URL invalide";
    header('Location: ruche.php');
}
