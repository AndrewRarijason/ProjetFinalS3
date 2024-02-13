<?php
// Inclure votre logique de connexion à la base de données ici
include('../models/fonctions.php');

// Vérifier si l'ID et la table sont définis dans l'URL
if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];
    
    // Échapper les valeurs pour éviter les injections SQL
    $id = mysqli_real_escape_string(connexion(), $id);
    $table = mysqli_real_escape_string(connexion(), $table);

    // Si le formulaire de suppression est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
        // Construire la requête de suppression
        delete($table, "id", $id);
        // Rediriger l'utilisateur vers la page précédente après la suppression
        header("Location: $_SERVER[HTTP_REFERER]");
        exit();
    }
} else {
    echo "ID et/ou table non spécifiés.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer l'entrée</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        button[type="submit"] {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Supprimer l'entrée</h1>
        <form method="post">
            <p>Êtes-vous sûr de vouloir supprimer cette entrée ?</p>
            <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
