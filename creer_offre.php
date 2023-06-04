<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titre = $_POST['titre'];
  $descriptions = $_POST['descriptions'];
  $createurId = $_POST['createur_id'];
  
  // Connexion à la base de données
  $conn = new PDO("mysql:host=localhost;dbname=linkedin", "root", "");

  // Insertion des données dans la table des offres d'emploi
  $stmt = $conn->prepare("INSERT INTO offres_emploi (titre, descriptions, createur_id) VALUES (?, ?, ?)");
  $stmt->execute([$titre, $descriptions, $createurId]);
  
  // Redirection vers la page des offres d'emploi après la création
  header("Location: emploi.php");
  exit();
}
?>
