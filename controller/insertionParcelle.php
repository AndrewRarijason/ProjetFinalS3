<?php

include ('../models/fonctions.php');

// Vérifier si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_GET["Parcelle"]) && isset($_GET["Surface"]) && isset($_GET["plante"]) &&
        !empty($_GET["Parcelle"]) && !empty($_GET["Surface"]) && !empty($_GET["plante"])) {

        // Récupérer les données du formulaire
        $Parcelle = $_GET["Parcelle"];
        $Surface = $_GET["Surface"];
        $plante = $_GET["plante"];

        // Insérer les données dans la base de données
        $colonnes = "nom_parcelle, surface, id_the";
        $valeurs = "'$Parcelle', '$Surface', '$plante'";
        insertion("parcelles", $colonnes, $valeurs); 

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
