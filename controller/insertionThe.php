<?php

include ('../models/fonctions.php');

// Vérifier si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_GET["varietyName"]) && isset($_GET["occupation"]) && isset($_GET["rendement"]) &&
        !empty($_GET["varietyName"]) && !empty($_GET["occupation"]) && !empty($_GET["rendement"])) {

        // Récupérer les données du formulaire
        $nomVariete = $_GET["varietyName"];
        $occupation = $_GET["occupation"];
        $rendement = $_GET["rendement"];

        // Insérer les données dans la base de données
        $colonnes = "nom, occupation, rendement";
        $valeurs = "'$nomVariete', '$occupation', '$rendement'";
        insertion("varietes_the", $colonnes, $valeurs); 

        // Rediriger vers une autre page après l'insertion réussie
        header("Location: success.php");
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
