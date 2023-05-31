<?php
//connexion à la base de données
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'Gabi2002!';
$dbName = 'amitie';

$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

$demandeurId = $_POST['demandeur_id'];  //récuperer les valeurs de la base de données
$receveurId = $_POST['receveur_id'];

$sql = "INSERT INTO demande_ami (demandeur_id, receveur_id, status)
        VALUES ('$demandeurId', '$receveurId', 'enattente')";
$result = $db->query($sql);

if($result){
    echo "Demande d'ami envoyée avec succès";
}else{
    echo "Erreur";
}

$db->close();
?>
