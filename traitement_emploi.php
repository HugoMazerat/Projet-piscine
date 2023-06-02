<?php
//récupération des données dans la base de données 
$Nom = $_POST['Nom'];
$Types = $_POST['Type'];
$Salaire = $_POST['Salaire'];
$Entreprise = $_POST['Entreprise'];
$Durée = $_POST['Durée'];

$servername = "localhost";           // ouverture du serveur
$username = "root";
$password = "";
$dbname = "linkedin";

$conn = new mysqli($servername, $username, $password, $dbname);    // connexion au serveur

if ($conn->connect_error){
    die("impossible d'ouvrir la base de données");
}

$sql = "INSERT INTO offre_emploi (Nom, Types, Salaire, Entreprise, Durée) VALUES('$Nom', '$Types', '$Salaire', '$Entreprise', '$Durée')";

if ($conn->query($sql)===TRUE){
    echo "L'offre a bien été ajouter";
} else {
    echo " Erreur lors de l'ajout";
}

$conn->close();
?>