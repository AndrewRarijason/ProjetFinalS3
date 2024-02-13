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
        <form action="liste_paiements.php" method="GET">
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
                    <th>Montant Paiement</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP code to populate table rows -->
                <?php
                // Check if start_date and end_date are set in URL
                if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                    $start_date = $_GET['start_date'];
                    $end_date = $_GET['end_date'];

                    // Include database connection and function to get payments
                    include('../models/fonctions.php');

                    // Get payments between start_date and end_date
                    $paiements = getPaiements($start_date, $end_date);

                    // Display payments in table rows
                    foreach ($paiements as $paiement) {
                        echo "<tr>";
                        echo "<td>{$paiement['date']}</td>";
                        echo "<td>{$paiement['nom_cueilleur']}</td>";
                        echo "<td>{$paiement['poids']}</td>";
                        echo "<td>{$paiement['pourcentage_bonus']}</td>";
                        echo "<td>{$paiement['pourcentage_mallus']}</td>";
                        echo "<td>{$paiement['montant_paiement']}</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
