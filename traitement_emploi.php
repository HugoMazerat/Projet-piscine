<?php
//récupération des données dans la base de données 
$Nom = $_POST['Nom'];
$Type = $_POST['Type'];
$Salaire = $_POST['Salaire'];
$Entreprise = $_POST['Entreprise'];
$Postulant = $_POST['Postulant'];

$servername = "localhost";           // ouverture du serveur
$username = "root";
$password = "Gabi2002!";
$dbname = "pj1";

$conn = new mysqli($servername, $username, $password, $dbname);    // connexion au serveur

if ($conn->connect_error){
    die("impossible d'ouvrir la base de données");
}

$sql = "INSERT INTO offre_emploi (Nom, Type, Salaire, Entreprise, Postulant) VALUES('$Nom', '$Type', '$Salaire', 'Entreprise', 'Postulant')";

if ($conn->query($sql)===TRUE){
    echo "L'offre a bien été ajouter";
} else {
    echo " Erreur lors de l'ajout";
}

$conn->close();
?>