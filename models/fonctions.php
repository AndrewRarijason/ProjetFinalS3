<?php
	include("Connexion.php");

//Pour valider la connexion d'un utilisateur ou d'un administrateur
    function validLogin($nom, $mdp, $type) //types=utilisateur/admin
    {
        $requete = "SELECT * FROM $type WHERE nom='$nom' AND mdp='$mdp'";
        $traitement = mysqli_query(connexion(), $requete);
        if(mysqli_num_rows($traitement) > 0) {return true;} 
        else { return false;}
    }
//Pour lister une table 
    function getAll($table)
    {
        $requete="select*from ".$table;
		$traitement=mysqli_query(connexion(), $requete);
        $retour=array();
        while($d=mysqli_fetch_assoc($traitement))
        {
            $retour[]=$d;
        }
        return $retour;
    }
//Pour supprimer une ligne d'une table avec conditionnementb(string)
    function delete($table, $condition, $valeur)
    {
        $requete="delete from ".$table." where ".$condition."='".$valeur."'";
        echo($requete);
		$traitement=mysqli_query(connexion(), $requete);	
    }
//Pour supprimer une ligne d'une table avec conditionnementb(nombre)
    function deleteNumber($table, $condition, $valeur)
    {
        $requete="delete from ".$table." where ".$condition."=".$valeur;
        echo($requete);
        $traitement=mysqli_query(connexion(), $requete);	
    }
//Pour modifier un champs dans une table (string)
    function update($table, $setChamp, $setValeur, $champ, $condition)
    {
        $requete="update ".$table." set".$setChamp."='".$setValeur."' where ".$champ."='".$condition."'";
		$traitement=mysqli_query(connexion(), $requete);  
    }
//Pour modifier un champs dans une table (nombre)
    function updateNumber($table, $setChamp, $setValeur, $champ, $condition)
    {
        $requete="update ".$table." set".$setChamp."=".$setValeur." where ".$champ."=".$condition;
        $traitement=mysqli_query(connexion(), $requete);  
    }
//Pour faire une insertion dans une table
    function insertion($table, $colonnes, $valeurs) //ou $colonnes de types string de la forme ex:"id, nom" de meme pour $valeurs
    {
        $requete = "INSERT INTO $table ($colonnes) VALUES ($valeurs)";
        $traitement = mysqli_query(connexion(), $requete);
    }
//Pour recuperer le rendement total qu'on peut esperer d'une parcelle
    function getRendementTotal($idParcelle)
    {
        $requete="select ((affichage.surface)*10000/Varietes_the.occupation)*Varietes_the.rendement as total from affichage join Varietes_the on affichage.id_variete=Varietes_the.id where affichage.id_parcelle=".$idParcelle;      
        echo($requete);
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Pour valider l'insertion a l'ajax
    function validPoids($poids, $date, $idParcelle) 
    {
        $mois = date("m", strtotime($date));
        $requete = "SELECT SUM(poids_cueilli) AS total FROM Cueillettes WHERE id_parcelle=$idParcelle AND MONTH(date_cueillette)=$mois";
        $traitement = mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $ret = getRendementTotal($idParcelle) - $d['total'];
        if($poids <= $ret) {return true;} 
        else {return false;}
    }
//Recuperer le total des cueilletes 
    function totalCueillete($dateDebut, $dateFin)
    {
        $requete="select sum(poids_cueilli) as total from Cueillettes where date_cueillette>'".$dateDebut."' and date_cueillette<='".$dateFin."'";
        echo($requete);
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Pour recuperer le rendement total (sans tenir en compte les parcelles)
    function getTotal()
    {
        $requete="select ((affichage.surface)*10000/Varietes_the.occupation)*Varietes_the.rendement as total from affichage join Varietes_the on affichage.id_variete=Varietes_the.id";   
        $traitement = mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour = $d['total'];
        return $retour;
    }
//Recuperer le poids restants sur les parcelles
    function poidRestant($dateDebut, $dateFin) 
    {
        $total = getTotal();
        $cueillis = totalCueillete($dateDebut, $dateFin);
        $retour = $total - $cueillis;
        return $retour;
    }
//Recuperer salaire pour toutes la cueillete
    function getSalaireTotal($dateDebut, $dateFin)
    {
        $requete="select sum(Salaires_cueilleurs.montant*Cueillettes.poids_cueilli) as total from Salaires_cueilleurs join Cueillettes on Salaires_cueilleurs.id=Cueillettes.id_cueilleur where date_cueillette >'".$dateDebut."' and date_cueillette<='".$dateFin."'";
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Pour recuperer le cout de revient
    function getCoutDeRevient($dateDebut, $dateFin) 
    {
        $requete = "SELECT SUM(montant) AS total FROM Depenses";
        $traitement = mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $depense = $d['total'] / getTotal();
        $salaireTotal = getSalaireTotal($dateDebut, $dateFin);
        $totalCueillete = totalCueillete($dateDebut, $dateFin);
        $depenses = ($salaireTotal / $totalCueillete) + $depense;
        return $depenses;
    }
?>