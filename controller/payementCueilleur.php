<?php
include ('../models/fonctions.php');

// Vérifier si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_GET["dailyWeight"]) && isset($_GET["bonusPercentage"]) && isset($_GET["malusPercentage"]) &&
        !empty($_GET["dailyWeight"]) && !empty($_GET["bonusPercentage"]) && !empty($_GET["malusPercentage"])) {

        // Récupérer les données du formulaire
        $dailyWeight = $_GET["dailyWeight"];
        $bonusPercentage = $_GET["bonusPercentage"];
        $malusPercentage = $_GET["malusPercentage"];

        // Insérer les données dans la base de données
        $colonnes = "poids_min, id_cueilleur, bonus, mallus";
        $valeurs = "'$dailyWeight',1 , '$bonusPercentage', '$malusPercentage'";
        insertion("payement_cueilleurs", $colonnes, $valeurs); 

        // Rediriger vers une autre page après l'insertion réussie
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
