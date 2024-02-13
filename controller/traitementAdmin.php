<?php
include ('../models/fonctions.php'); // Inclure le fichier contenant la fonction validLogin

// Vérification des identifiants
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Appeler la fonction validLogin
    if(validLogin($username, $password, 'Admin')) { // 'admin' comme type d'utilisateur
        // Redirection vers la page de succès après un login réussi
        header("Location: ../views/admin.html");
        exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
    } else {
        echo "Identifiants incorrects. Veuillez réessayer.";
    }
} else {
    echo "Veuillez entrer à la fois un nom d'utilisateur et un mot de passe.";
}
?>
