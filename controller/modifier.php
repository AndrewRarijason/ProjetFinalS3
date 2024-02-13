<?php
include('../models/Connexion.php');
// Vérifier si les paramètres nécessaires sont spécifiés dans l'URL
if (isset($_GET['table']) && isset($_GET['id'])) {
    $table = $_GET['table'];
    $id = $_GET['id'];

    // Traitement du formulaire de modification
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les nouvelles valeurs des champs du formulaire
        // Assurez-vous de valider et d'échapper les données pour éviter les attaques par injection SQL
        $nouvellesValeurs = array();
        foreach ($_POST as $key => $value) {
            $nouvellesValeurs[$key] = htmlspecialchars($_POST[$key]);
        }

        // Construire la requête de mise à jour
        $setClause = "";
        foreach ($nouvellesValeurs as $colonne => $valeur) {
            $setClause .= "$colonne='$valeur',";
        }
        // Supprimer la virgule en trop à la fin de la chaîne
        $setClause = rtrim($setClause, ",");

        // Exécuter la requête de mise à jour
        update($table, $setClause, "id", $id);

        // Rediriger l'utilisateur vers la page de liste des données après la modification
        header("Location: liste.php?table=$table");
        exit();
    }

    // Récupérer les informations de la ligne à modifier
    $requete = "SELECT * FROM $table WHERE id=$id";
    $resultat = mysqli_query(connexion(), $requete);
    $ligne = mysqli_fetch_assoc($resultat);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la ligne <?php echo $id; ?></title>
</head>
<body>
    <h1>Modifier la ligne <?php echo $id; ?></h1>
    <form method="post">
        <?php foreach ($ligne as $colonne => $valeur) { ?>
            <label for="<?php echo $colonne; ?>"><?php echo $colonne; ?>:</label>
            <input type="text" id="<?php echo $colonne; ?>" name="<?php echo $colonne; ?>" value="<?php echo $valeur; ?>"><br>
        <?php } ?>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</body>
</html>
<?php
} else {
    // Rediriger vers une autre page si les paramètres nécessaires ne sont pas spécifiés
    header("Location: index.html");
    exit();
}

function update($table, $setClause, $conditionField, $conditionValue)
{
    $requete = "UPDATE $table SET $setClause WHERE $conditionField=$conditionValue";
    mysqli_query(connexion(), $requete);
}
?>
