<?php
include ('../models/fonctions.php');

// Vérifier si des données ont été soumises via le formulaire
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Vérifier si les champs du formulaire sont définis et non vides
    if (isset($_GET["montant"]) && isset($_GET["variete_the"]) &&
        !empty($_GET["montant"]) && !empty($_GET["variete_the"])) {

        // Récupérer les données du formulaire
        $montant = $_GET["montant"];       
        $variete_the = $_GET["variete_the"];
                 
            
            // Insérer les données dans la base de données
            $colonnes = "montant, id_variete";
            $valeurs = "'$montant', $variete_the";
            insertion("prix_variete", $colonnes, $valeurs); 

            // Rediriger vers une autre page après l'insertion réussie
            $filePath = '../views/success.php';
            header("Location: $filePath");
            exit();
    }
}
?>
