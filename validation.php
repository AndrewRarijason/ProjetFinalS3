<?php
    include('Fonctions.php');

    // Récupération des données envoyées par le formulaire
    $dateCueillete = $_POST['dateCueillete'];
    $cueilleur = $_POST['cueilleur'];
    $parcelle = $_POST['parcelle'];
    $poids = $_POST['poids'];

    // Validation du poids
    $final = validPoids($poids, $dateCueillete, $parcelle);

    // Si la validation réussit, effectuer l'insertion dans la base de données
    if ($final) {
        $table = "Cueillettes"; 
        $colonnes = "date_cueillette, id_parcelle, id_cueilleur, poids_cueilli";
        // Utilisation de guillemets simples pour les chaînes de caractères dans les valeurs
        $valeurs = "'$dateCueillete', $parcelle, $cueilleur, $poids";
        insertion($table, $colonnes, $valeurs); 

        // Redirection avec un message de succès
        header("Location: cueillette.php");
        exit(); // Terminer le script après la redirection
    } else {
        // Redirection avec un message d'échec
        header("Location: validFinal.php");
        exit(); // Terminer le script après la redirection
    }
?>
