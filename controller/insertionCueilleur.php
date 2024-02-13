<?php

include ('../models/fonctions.php');

// Vérifier si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_GET["nom"]) && isset($_GET["genre"]) && isset($_GET["Date"]) &&
        !empty($_GET["nom"]) && !empty($_GET["genre"]) && !empty($_GET["Date"])) {

        // Récupérer les données du formulaire
        $nom = $_GET["nom"];
        $genre = $_GET["genre"];
        $Date = $_GET["Date"];

        // Insérer les données dans la base de données
        $colonnes = "nom, genre, date_naissance";
        $valeurs = "'$nom', '$genre', '$Date'";
        insertion("Cueilleurs", $colonnes, $valeurs); 

        $filePath = '../views/success.php';
            header("Location: $filePath");
        exit();
    } else {
        // Afficher un message d'erreur si des champs sont manquants dans le formulaire
        echo "Tous les champs du formulaire sont obligatoires.";
    }
} else {
    // Rediriger vers une autre page si le formulaire n'a pas été soumis via la méthode GET
    header("Location: index.php");
    exit();
}
?>
