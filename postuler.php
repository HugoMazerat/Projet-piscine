<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $offreId = $_POST['offre_id'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  
  // Connexion à la base de données
  $conn = new PDO("mysql:host=localhost;dbname=linkedin", "root", "");

  // Insertion des données dans la table de postulation
  $stmt = $conn->prepare("INSERT INTO postulations (offre_id, nom, prenom, email) VALUES (?, ?, ?, ?)");
  $stmt->execute([$offreId, $nom, $prenom, $email]);
  
  // Redirection vers la page des offres d'emploi après la postulation
  header("Location: emploi.php");
  exit();
}

// Récupérer l'ID de l'offre d'emploi depuis l'URL
$offreId = $_GET['id'];

// Connexion à la base de données
$conn = new PDO("mysql:host=localhost;dbname=linkedin", "root", "");

// Récupérer les informations de l'offre d'emploi
$stmt = $conn->prepare("SELECT * FROM offres_emploi WHERE id = ?");
$stmt->execute([$offreId]);
$offre = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Postuler à l'offre d'emploi</title>
  <style>
    /* Votre CSS ici */
  </style>
</head>
<body>
  <h1>Postuler à l'offre d'emploi</h1>
  
  <form method="POST" action="postuler.php">
    <input type="hidden" name="offre_id" value="<?php echo $offreId; ?>">
    
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" required>
    
    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" required>
    
    <label for="email">Adresse email :</label>
    <input type="email" name="email" id="email" required>
    
    <input type="submit" value="Postuler">
  </form>
</body>
</html>
