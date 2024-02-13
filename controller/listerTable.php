<?php
include('../models/fonctions.php');

// Vérifier si le paramètre de table est spécifié dans l'URL
if (isset($_GET['table'])) {
    $table = $_GET['table'];

    // Appeler la fonction getAll pour récupérer toutes les données de la table spécifiée
    $donnees = getAll($table);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des données</title>
</head>
<body>
    <h1>Liste des données de la table <?php echo $table; ?></h1>
    <table border="1">
        <tr>
            <!-- En-têtes de colonnes -->
            <?php foreach ($donnees[0] as $colonne => $valeur) { ?>
                <th><?php echo $colonne; ?></th>
            <?php } ?>
            <!-- Ajout de colonnes pour les liens de modification et de suppression -->
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        <!-- Affichage des données -->
        <?php foreach ($donnees as $ligne) { ?>
            <tr>
                <?php foreach ($ligne as $valeur) { ?>
                    <td><?php echo $valeur; ?></td>
                <?php } ?>
                <!-- Ajout de liens de modification et de suppression pour chaque ligne -->
                <td><a href="modifier.php?table=<?php echo $table; ?>&id=<?php echo $ligne['id']; ?>">Modifier</a></td>
                <td><a href="supprimer.php?table=<?php echo $table; ?>&id=<?php echo $ligne['id']; ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php
} else {
    // Rediriger vers une autre page si le paramètre de table n'est pas spécifié
    header("Location: index.html");
    exit();
}
?>
