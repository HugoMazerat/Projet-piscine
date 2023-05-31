<?php
// Connexion à la base de données
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = 'Gabi2002!';
$dbName = 'amitie';

$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// ID des utilisateurs
$u1Id = 1; // Remplacez par l'ID du premier utilisateur
$u2Id = 2; // Remplacez par l'ID du deuxième utilisateur

// Vérifier si la relation d'amitié n'existe pas déjà
$sql = "SELECT COUNT(*) AS count FROM amis WHERE (u1_id = $1Id AND u2_id = $u2Id) OR (u1_id = $u2Id AND u2_id = $u1Id)";
$result = $db->query($sql);

$row = $result->fetch_assoc();
$count = $row['count'];

if ($count == 0) {
    // Insérer la relation d'amitié dans la base de données
    $sqlInsert = "INSERT INTO amis (u1_id, u2_id) VALUES ($u1Id, $u2Id)";
    $resultInsert = $db->query($sqlInsert);

    if ($resultInsert) {
        echo "La relation d'amitié a été ajoutée avec succès !";
    } else {
        echo "Erreur lors de l'ajout de la relation d'amitié : " . $db->error;
    }
} else {
    echo "La relation d'amitié existe déjà.";
}

$db->close();
?>
