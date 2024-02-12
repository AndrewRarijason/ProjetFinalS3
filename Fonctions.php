<?php
	include("Connexion.php");

//Pour valider la connexion d'un utilisateur ou d'un administrateur
    function validLogin($nom, $mdp, $type) //types=utilisateur/admin
    {
        $requete="select*from ".$type." where nom='".$nom."' and mdp='".$mdp."'";
        $traitement=mysqli_query(connexion(), $requete);
        if($traitement!=null){return true;}
        else{return false};
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
        $requete="delete ".$table." where".$condition."=".$valeur;
		$traitement=mysqli_query(connexion(), $requete);	
    }
//Pour modifier un champs dans une table
    function update($table, $setChamp, $setValeur, $champ, $condition)
    {
        $requete="update ".$table." set".$setChamp."=".$setValeur." where ".$champ."=".$condition;
		$traitement=mysqli_query(connexion(), $requete);  
    }
//Pour faire une insertion dans une table
    function insert($table, $colonnes, $valeurs) //ou $colonnes de types string de la forme ex:"id, nom" de meme pour $valeurs
    {
        $requete="insert into".$table."(".$colonnes.") values (".$valeurs.")";
        $traitement=mysqli_query(connexion(), $requete);
    }

?>



