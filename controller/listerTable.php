<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des données</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Custom CSS for smaller text */
        .smaller-text {
            font-size: 0.9rem;
        }

        /* Custom CSS for table */
        .table th, .table td {
            vertical-align: middle;
        }

        /* Custom CSS for table actions */
        .table-actions a {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php
        include('../models/fonctions.php');

        // Vérifier si le paramètre de table est spécifié dans l'URL
        if (isset($_GET['table'])) {
            $table = $_GET['table'];

            // Appeler la fonction getAll pour récupérer toutes les données de la table spécifiée
            $donnees = getAll($table);
        ?>
        <h1 class="mb-4">Liste des données de la table <?php echo $table; ?></h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <!-- En-têtes de colonnes -->
                    <?php foreach ($donnees[0] as $colonne => $valeur) { ?>
                        <th><?php echo $colonne; ?></th>
                    <?php } ?>
                    <!-- Colonnes pour les actions -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Affichage des données -->
                <?php foreach ($donnees as $ligne) { ?>
                    <tr>
                        <?php foreach ($ligne as $valeur) { ?>
                            <td><?php echo $valeur; ?></td>
                        <?php } ?>
                        <!-- Liens de modification et de suppression -->
                        <td class="table-actions">
                            <a href="modifier.php?table=<?php echo $table; ?>&id=<?php echo $ligne['id']; ?>" class="btn btn-sm btn-primary">Modifier</a>
                            <a href="supprimer.php?table=<?php echo $table; ?>&id=<?php echo $ligne['id']; ?>" class="btn btn-sm btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
        } else {
            // Rediriger vers une autre page si le paramètre de table n'est pas spécifié
            header("Location: index.html");
            exit();
        }
        ?>
    </div>
</body>
</html>