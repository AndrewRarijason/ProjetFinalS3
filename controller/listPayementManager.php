<?php
// Vérifier si start_date et end_date sont définis dans l'URL
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    // Inclure la connexion à la base de données et la fonction pour récupérer les paiements
    include('../models/fonctions.php');

    // Utiliser la fonction getSalaireTotal() pour récupérer les paiements des cueilleurs
    $paiements = getDonnees($start_date, $end_date);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des paiements pour les cueilleurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Liste des paiements pour les cueilleurs</h1>
        <form action="../controller/listPayementManager.php" method="get">
            <div class="form-group">
                <label for="start_date">Date de début :</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="form-group">
                <label for="end_date">Date de fin :</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>

        <!-- Table to display payments -->
        <table class="table table-bordered mt-4">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Nom Cueilleur</th>
                    <th>Poids</th>
                    <th>% Bonus</th>
                    <th>% Mallus</th>
                    <th>Poids minimum</th>
                    <th>Montant Paiement</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paiements as $paiement): ?>
                    <tr>
                        <td><?php echo $paiement['date_cueillette']; ?></td>
                        <td><?php echo $paiement['nom']; ?></td>
                        <td><?php echo $paiement['poids']; ?></td>
                        <td><?php echo $paiement['bonus']; ?></td>
                        <td><?php echo $paiement['mallus']; ?></td>
                        <td><?php echo $paiement['poids_min']; ?></td>
                        <td><?php echo $paiement['montant']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
