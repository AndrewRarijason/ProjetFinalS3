<?php
    function connexion() 
    {
        $serveur = "localhost";
        $utilisateur = "root";
        $motDePasse = "";
        $baseDeDonnees = "";

        $connexion = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

        if ($connexion->connect_error) 
        {
            die("Erreur lors de la connexion : " . $connexion->connect_error);
        }
        return $connexion;
    }
?>