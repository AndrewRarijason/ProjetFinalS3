<?php
    function connexion() 
    {
        $serveur = "localhost";
        $utilisateur = "ETU002515";
        $motDePasse = "h76bHHwPshRc";
        $baseDeDonnees = "the";

        $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

        if ($connexion->connect_error) 
        {
            die("Erreur lors de la connexion : " . $connexion->connect_error);
        }
        return $connexion;
    }
?>