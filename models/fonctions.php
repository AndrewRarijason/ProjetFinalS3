<?php
	include('Connexion.php');

//Pour valider la connexion d'un utilisateur ou d'un administrateur
// Pour valider la connexion d'un utilisateur ou d'un administrateur
    function validLogin($nom, $mdp, $type) // types=utilisateur/admin
    {
        $connexion = connexion(); // Appeler la fonction de connexion à la base de données

        // Échapper les entrées pour éviter les attaques par injection SQL
        $nom = mysqli_real_escape_string($connexion, $nom);
        $mdp = mysqli_real_escape_string($connexion, $mdp);

        $requete = "SELECT * FROM " . $type . " WHERE nom='" . $nom . "' AND mdp='" . $mdp . "'";
        $traitement = mysqli_query($connexion, $requete);

        if ($traitement && mysqli_num_rows($traitement) > 0) {
        // Si la requête a réussi et qu'il y a au moins une ligne de résultat
            return true;
        } else {
            return false;
        }
    }
    
//Pour lister une table 
    function getAll($table)
    {
        $requete="select*from ".$table;
		$traitement=mysqli_query(connexion(), $requete);
        $retour=array();
        $retour=mysqli_fetch_assoc($traitement);
        return $retour;
    }
//Pour supprimer une ligne d'une table avec conditionnement
    function delete($table, $condition, $valeur)
    {
        $requete="delete ".$table." where ".$condition."=".$valeur;
		$traitement=mysqli_query(connexion(), $requete);	
    }
//Pour modifier un champs dans une table
    function update($table, $setChamp, $setValeur, $champ, $condition)
    {
        $requete="update ".$table." set".$setChamp."=".$setValeur." where ".$champ."=".$condition;
		$traitement=mysqli_query(connexion(), $requete);  
    }
//Pour faire une insertion dans une table
    function insertion($table, $colonnes, $valeurs) //ou $colonnes de types string de la forme ex:"id, nom" de meme pour $valeurs
    {
        $requete="insert into ".$table."(".$colonnes.") values (".$valeurs.")";
        $traitement=mysqli_query(connexion(), $requete);
    }
//Pour recuperer le rendement total qu'on peut esperer d'une parcelle
    function getRendementTotal($idParcelle)
    {
        $requete="select ((affichage.parcelle)*10000/the.occupation)*the.rendement as total from affichage join the on affichage.id_the=the.id where affichage.id_parcelle=".$idParcelle;      
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Pour valider l'insertion a l'ajax
    function validPoids($poids, $date, $idParcelle)
    {
        $mois=month($date);
        $requete="select sum(poids) as total from cueillete where id_parcelle=".$idParcelle." and month(date_cueillete)=".$mois;
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $ret=getRendementTotal($idParcelle)-$d['total'];
        if($poids<=$ret){return true;}
        else{return false;}
        return $retour;
    }
//Recuperer le total des cueilletes 
    function totalCueillete()
    {
        $requete="select sum(poids) as total from cueillette";
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Pour recuperer le rendement total (sans tenir en compte les parcelles)
    function getTotal()
    {
        $requete="select ((affichage.parcelle)*10000/the.occupation)*the.rendement as total from affichage join the on affichage.id_the=the.id";      
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Recuperer le poids restants sur les parcelles
    function poidRestant()
    {
        $total=getTotal();
        $cueillis=totalCueillete();
        $retour=$total-$cueillis;
        return retour;
    }
//Recuperer salaire pour toutes la cueillete
    function getSalaireTotal()
    {
        $requete="select sum(salaire.montant*cueillete.poids) as total from salaire join cueillete on salaire.id_cueilleur=cueillete.id_cueilleur";
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Pour recuperer le cout de revient
    function getCoutDeRevient()
    {
        $requete="select sum(montant) as total from depense";
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $depense=$d['total']/getRendementTotal();
        $retour=(getSalaireTotal()/totalCueillete())+$depenses;
    }