<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // on vérif si le formulaire est soumis

  $offreId = $_POST['offre_id'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];

  $bdd = new PDO("mysql:host=localhost;dbname=linkedin", "root", ""); // Connexion à la BDD

  $stmt = $bdd->prepare("INSERT INTO postulations (offre_id, nom, prenom, email) VALUES (?, ?, ?, ?)"); // on insert les infos dans la table "postulations"
  $stmt->execute([$offreId, $nom, $prenom, $email]);


  header("Location: emploi.php"); // on redirige vers la page d'accueil
  exit();
}

$offreId = $_GET['id']; // on récup l'ID de l'offre  dans l'url

$bdd = new PDO("mysql:host=localhost;dbname=linkedin", "root", ""); // Connexion à la BDD

$stmt = $bdd->prepare("SELECT * FROM offres_emploi WHERE id = ?"); // recup des info de l'offre avec la requete SQL
$stmt->execute([$offreId]);
$offre = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Postuler à l'offre d'emploi</title>  
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