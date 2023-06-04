<?php

//on récup les infos de la BDD
$Nom = $_POST['Nom'];
$Types = $_POST['Type'];
$Salaire = $_POST['Salaire'];
$Entreprise = $_POST['Entreprise'];
$Durée = $_POST['Durée'];

$servername = "localhost";          
$password = "";
$dbname = "linkedin";
$conn = new mysqli($servername, $username, $password, $dbname);    // connexion à la BDD

if ($conn->connect_error){
    die("impossible d'acceder à la base de données");
}

$sql = "INSERT INTO offre_emploi (Nom, Types, Salaire, Entreprise, Durée) VALUES('$Nom', '$Types', '$Salaire', '$Entreprise', '$Durée')"; // requete SQL pour insérer des info dans la BDD

if ($conn->query($sql)===TRUE){
    echo "L'offre est ajoutée";
} else {
    echo "Erreur lors de l'ajout de l'offre";
}

$conn->close();
?>