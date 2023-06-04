<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // si le formulaire est soumis
  $titre = $_POST['titre'];
  $descriptions = $_POST['descriptions'];
  $createurId = $_POST['createur_id'];
  
  $conn = new PDO("mysql:host=localhost;dbname=linkedin", "root", ""); // connexion à la BDD

  $stmt = $conn->prepare("INSERT INTO offres_emploi (titre, descriptions, createur_id) VALUES (?, ?, ?)"); // on insert les données dans la table 
  $stmt->execute([$titre, $descriptions, $createurId]);
  
  header("Location: emploi.php"); // qd l'offre est créée on redirige vers la page d'emploi
  exit();
}
?>
