<?php

include ('../models/fonctions.php');

// Vérifier si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_GET["type"]) && isset($_GET["Montant"]) && isset($_GET["date"]) &&
        !empty($_GET["type"]) && !empty($_GET["Montant"]) && !empty($_GET["date"])) {

        // Récupérer les données du formulaire
        $type = $_GET["type"];
        $Montant = $_GET["Montant"];
        $date = $_GET["date"];

        // Insérer les données dans la base de données
        $colonnes = "nom, montant, date_depense";
        $valeurs = "'$type', '$Montant', '$date'";
        insertion("Depenses", $colonnes, $valeurs); 

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
