<?php

include ('../models/fonctions.php');

// Vérifier si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_GET["cueilleurs"]) && isset($_GET["Montant"]) &&
        !empty($_GET["cueilleurs"]) && !empty($_GET["Montant"])) {

        // Récupérer les données du formulaire
        $type = $_GET["cueilleurs"];
        $Montant = $_GET["Montant"];

        // Insérer les données dans la base de données
        $colonnes = "id_cueilleur, montant";
        $valeurs = "'$type', '$Montant'";
        insertion("Salaires_cueilleurs", $colonnes, $valeurs); 

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
