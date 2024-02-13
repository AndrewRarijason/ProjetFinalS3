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
		$traitement=mysqli_query(connexion(), $requete);	
    }
//Pour supprimer une ligne d'une table avec conditionnementb(nombre)
    function deleteNumber($table, $condition, $valeur)
    {
        $requete="delete from ".$table." where ".$condition."=".$valeur;
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
//Genere automatiquement le rendement
    function updateRendement($dateDebut, $dateFin) 
    {
        $requete = "SELECT id FROM regeneration WHERE mois BETWEEN '".$dateDebut."' AND '".$dateFin."'";
        $result = mysqli_query(connexion(), $requete);
        if ($result->num_rows > 0) 
        {
            $sql_update = "UPDATE the SET rendement = rendement * 2";
            $result = mysqli_query(connexion(), $sql_update);
            echo "Rendement mis à jour avec succès!";
        } else {
            echo "Aucun mois trouvé entre les dates spécifiées.";
        }
    }
//Recuperer le total des cueilletes 
    function totalCueillete($dateDebut, $dateFin) //independant
    {
        $requete="select sum(poids_cueilli) as total from Cueillettes where date_cueillette>'".$dateDebut."' and date_cueillette<='".$dateFin."'";
        $traitement=mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour=$d['total'];
        return $retour;
    }
//Pour recuperer le rendement total (sans tenir en compte les parcelles)
    function getTotal($dateDebut, $dateFin)  
    {
        updateRendement($dateDebut, $dateFin);
        $requete="select ((affichage.surface)*10000/Varietes_the.occupation)*Varietes_the.rendement as total from affichage join Varietes_the on affichage.id_variete=Varietes_the.id";   
        $traitement = mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $retour = $d['total'];
        return $retour;
    }
//Recuperer le poids restants sur les parcelles
    function poidRestant($dateDebut, $dateFin) //change
    {
        $total = getTotal($dateDebut, $dateFin);
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

//Pour recuperer le salaire
    function getSalaire()
    {
        $requete = "SELECT montant FROM Salaires_cueilleurs";
        $traitement = mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc();  
        $retour = $d['montant'];
        return $retour;
    }
//Pour recuperer les valeurs dans la view v_montant pour une date et un cueilleur
    function getInfos($dateD, $nom)
    {
        $requete="select*from v_montant where date_cueillette='".$dateD."' and nom='".$nom."'";
        $traitement=mysqli_query(connexion(), $requete);
        $retour=array();
        while($d=mysqli_fetch_assoc($traitement))
        {
            $retour[]=$d;
        }
        return $retour;
    }
//Pour calculer le montant a payer lister dans la table
    function getMontant($dateD, $nom)
    {
        $donnees=getInfos($dateD, $nom);
        $montant=getSalaire();
        $aPayer=0;
        foreach($donnees as $row)
        {  
            $validPoids=$row['poids_cueilli'];
            $poids_min=$row['poids_min'];
            $bonus=$row['bonus']; $mallus=$row['mallus'];
            if($validPoids<$poids_min && $validPoids>0)
            {
                $moins=$poids_min-$validPoids;
                $aPayer=($montant*$validPoids)-($moins*($montant*$mallus)/100);
            }
            if ($validPoids>$poids_min)
            {
                $plus=$validPoids+$poids_min;
                $aPayer=($montant*$validPoids)+($plus*($montant*$bonus)/100);
            }
            if($validPoids=$poids_min){$aPayer=$montant*$validPoids;}
            else{$aPayer==0;}
            return aPayer;
        }
    }
//Pour recuperer les donnees pour une date debut et date fin
    function getDonnees($dateDebut, $dateFin)
    {
        $donnees = "SELECT * FROM v_montant WHERE date_cueillette > '".$dateDebut."' AND date_cueillette <= '".$dateFin."'";
        $traitement = mysqli_query(connexion(), $donnees);
        $retour = array();
        while ($d = mysqli_fetch_assoc($traitement))
        {
            $montant = getMontant($d['date_cueillette'], $d['nom']);
            $d['montant'] = $montant;
            $retour[] = $d;
        }
        return $retour;
    }
//Pour calculer le montant total des ventes
    function getMontantVente($dateDebut, $dateFin)
    {
        $requete="SELECT SUM(C.poids_cueilli * PV.montant) AS somme
        FROM Cueillettes C
        JOIN Parcelles P ON C.id_parcelle = P.id
        JOIN prix_variete PV ON P.id_the = PV.id_variete where date_cueillette>'".$dateDebut."' and date_cueillette<='".$dateFin."'";
         $traitement = mysqli_query(connexion(), $requete);
         $d = $traitement->fetch_assoc(); 
         $retour= $d['somme'];
         return $retour;
    }
//Pour calculer le total des depenses
    function totalDepenses($dateDebut, $dateFin)
    {
        $requete="select sum(montant) as total from Depenses where date_depense>'".$dateDebut."' and date_depense<='".$dateFin."'";
        $traitement = mysqli_query(connexion(), $requete);
        $d = $traitement->fetch_assoc(); 
        $depense = $d['total'];
        return $depense;
    }
//Pour recuperer le cout de revient
    function getCoutDeRevient($dateDebut, $dateFin) 
    {
        $depense=totalDepenses($dateDebut, $dateFin);
        $salaireTotal = getSalaireTotal($dateDebut, $dateFin);
        $totalCueillete = totalCueillete($dateDebut, $dateFin);
        return $depenses;
    }
//Pour recuperer le benefice
    function getBenefice($dateDebut, $dateFin)
    {
        $ventes=getMontantVente($dateDebut, $dateFin);
        $revient=getCoutDeRevient($dateDebut, $dateFin);
        return $ventes-$revient;
    }
?>



