<?php
//connexion à la base de données
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'Gabi2002!';
$dbName = 'amitie';

$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

//récupérer les demandes de la premiere personne de la base de données
$currentUtilisateurId=1;
$sql = "SELECT demande_ami.id, utilisateur.nom AS demandeur_nom, demande_ami.temps
        FROM demande_ami
        INNER JOIN utilisateur ON demande_ami.demandeur_id = utilisateur.id
        WHERE demande_ami.receveur_id = $currentUtilisateurID";
$result = $db->query($sql);

$demandeamis = array();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $demandeamis[] = $row;
    }
}
//afficher la page html

include 'demandeami.html';
?>