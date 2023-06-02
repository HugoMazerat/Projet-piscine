<!DOCTYPE html>
<html>
<head>
  <title>Offres d'emploi</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Offres d'emploi</h1>
  <h2>Liste des offres d'emploi</h2>

  <?php
  // Connexion à la base de données
  $connexion = mysqli_connect('localhost', 'root', '', 'linkedin');
  if (!$connexion) {
    die('Erreur de connexion à la base de données');
  }

  // Récupération des offres d'emploi avec les informations du créateur
  $query = "SELECT offres_emploi.*, utilisateurs.nom, utilisateurs.prenom, utilisateurs.mail
            FROM offres_emploi
            INNER JOIN utilisateurs ON offres_emploi.utilisateur_id = utilisateurs.ID";
  $result = mysqli_query($connexion, $query);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="offre">';
      echo '<h3>' . $row['titre'] . '</h3>';
      echo '<p>' . $row['descriptions'] . '</p>';
      echo '<p>Créé par: ' . $row['prenom'] . ' ' . $row['nom'] . ' (' . $row['mail'] . ')</p>';
      echo '<p><a href="postuler.php?id=' . $row['id'] . '">Postuler</a></p>';
      echo '</div>';
    }
  } else {
    echo 'Aucune offre d\'emploi disponible.';
  }

  // Fermeture de la connexion à la base de données
  mysqli_close($connexion);
  ?>

  <h2>Créer une offre d'emploi</h2>
  <form action="creer_offre.php" method="POST">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" required><br>
    <label for="descriptions">Descriptions :</label>
    <textarea name="description" required></textarea><br>
    <input type="submit" value="Créer">
  </form>
</body>
</html>
