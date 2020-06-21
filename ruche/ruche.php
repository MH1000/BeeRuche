<?php
// On démarre une session
session_start();

// On inclut la connexion à la base
require_once('connect.php');

$sql = 'SELECT * FROM `ruche`';

// On prépare la requête
$query = $db->prepare($sql);

// On exécute la requête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des ruches</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">

        <a class="navbar-brand" href="index.php?">Accueil</i></a>
        <a class="navbar-brand" href="index.php?">Ruches</i></a>
        <a class="navbar-brand" href="index.php?">informations</i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="?action=logout">Se déconnecter<span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="card ">
                <a href="add.php" class="btn btn-primary">Ajouter une ruche</a>
            </div>

            <div class="card-body pr-2 pl-2">

                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div id="example_filter" class="dataTables_filter "><label><input type="search" class="form-control form-control-sm" placeholder="Rechercher..." aria-controls="example"></label></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row">
                                        <th class="text-center sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 72px;" aria-label="Nom activate to sort column ascending">Nom</th>
                                        <th class="text-center sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 142px;" aria-label="address: activate to sort column ascending">Lattidude</th>
                                        <th class="text-center sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 66px;" aria-label=" activate to sort column ascending">Longitude</th>
                                        <th class="text-center sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 231px;" aria-label="Action: activate to sort column ascending" width="25%">Action</th>
                                    </tr>
                                    <td>
                                        <a class="btn btn-info btn-sm " href="profile.php?i">Modifier</a>
                                        <a onclick="return confirm('Etes-vous sur de supprimer  ?')" class="btn btn-danger
                                                 btn-sm " href="?remove=21">Supprimé</a>
                                    <td>
                                    </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_length" id="example_length"><label></label><select name="example_length" aria-controls="example" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> Lignes par pages </label></div>
                            <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Ligne 1 à 2 sur 2 entrées</div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled" id="example_previous"><a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">
                                            <</a> </li> <li class="paginate_button page-item active"><a href="#" aria-controls="example" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                    <li class="paginate_button page-item next disabled" id="example_next"><a href="#" aria-controls="example" data-dt-idx="2" tabindex="0" class="page-link">
                                            ></a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <table class="table">
                        <thead>
                            <th>Nom</th>
                            <th>Lattitude</th>
                            <th>Longitude</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            // On boucle sur la variable result
                            foreach ($ruchess as $ruches) {
                            ?>
                                <tr>
                                    <td><?= $ruches['ruche'] ?></td>
                                    <td><?= $ruches['lattitude'] ?></td>
                                    <td><?= $ruches['longitude'] ?></td>
                                    <td>
                                        </a><a href="details.php?id=<?= $ruches['id'] ?>">Voir</a> <a href="edit.php?id=<?= $ruches['id'] ?>">Modifier</a> <a href="delete.php?id=<?= $ruches['id'] ?>">Supprimer</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="add.php" class="btn btn-primary">Ajouter un ruche</a>
                </section>
            </div>
            </main>
        </div>

        <script src="assets/jquery.min.js"></script>
        <script src="assets/bootstrap.min.js"></script>
        <script src="assets/jquery.dataTables.min.js"></script>
        <script src="assets/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#flash-msg").delay(7000).fadeOut("slow");
            });
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>

</body>

</html>