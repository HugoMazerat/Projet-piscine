<?php
// Démarrez la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['ID'])) {
  // Utilisateur connecté
  $userId = $_SESSION['ID'];

  // Connexion à la base de données
  $conn = new PDO("mysql:host=localhost;dbname=linkedin", "root", "");

  // Récupérer les offres d'emploi
  $offres = $conn->query("SELECT * FROM offres_emploi")->fetchAll(PDO::FETCH_ASSOC);
} else {
  // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Liste des offres d'emploi</title>
  <style>
    /* Votre CSS ici */
  </style>
</head>

<body>
  <h1>Liste des offres d'emploi</h1>

  <table>
    <tr>
      <th>Titre</th>
      <th>Descriptions</th>
      <th>Créateur</th>
      <th>Action</th>
    </tr>

    <?php foreach ($offres as $offre) : ?>
      <tr>
        <td><?php echo $offre['titre']; ?></td>
        <td><?php echo $offre['descriptions']; ?></td>
        <td><?php echo $offre['createur_id']; ?></td>
        <td><a href="postuler.php?id=<?php echo $offre['id']; ?>">Postuler</a></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <h2>Créer une offre d'emploi</h2>

  <form method="POST" action="creer_offre.php">
    <input type="hidden" name="createur_id" value="<?php echo $userId; ?>">


    <label for="titre">Titre :</label>
    <input type="text" name="titre" id="titre" required>

    <label for="description">Description :</label>
    <textarea name="descriptions" id="descriptions" required></textarea>

    <input type="submit" value="Créer">
  </form>
</body>

</html>