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

    // Construire la requête de suppression
    delete($table, "id", $id);
/*
    // Exécuter la requête de suppression
    if (delete($table, "id", $id)) {
        echo "La ligne a été supprimée avec succès.";
    } else {
        echo "Erreur lors de la suppression de la ligne : " . mysqli_error(connexion());
    }*/
} else {
    echo "ID et/ou table non spécifiés.";
}
?>