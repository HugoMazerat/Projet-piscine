<!DOCTYPE html>
<html>
<head>
  <title>Postuler</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h1>Postuler à une offre d'emploi</h1>

  <?php
  // Vérifier si l'ID de l'offre d'emploi est passé en paramètre
  if (isset($_GET['id'])) {
    $offre_id = $_GET['id'];

    // Connexion à la base de données
    $connexion = mysqli_connect('localhost', 'root', '', 'linkedin');
    if (!$connexion) {
      die('Erreur de connexion à la base de données');
    }

    // Récupérer les détails de l'offre d'emploi avec les informations du créateur
    $query = "SELECT offres_emploi.*, utilisateurs.nom, utilisateurs.prenom, utilisateurs.email
              FROM offres_emploi
              INNER JOIN utilisateurs ON offres_emploi.utilisateur_id = utilisateurs.ID
              WHERE offres_emploi.id = $offre_id";
    $result = mysqli_query($connexion, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
      echo '<h2>' . $row['titre'] . '</h2>';
      echo '<p>' . $row['descriptions'] . '</p>';
      echo '<p>Créé par: ' . $row['prenom'] . ' ' . $row['nom'] . ' (' . $row['mail'] . ')</p>';

      echo '<h2>Formulaire de candidature</h2>';
      echo '<form action="candidature.php" method="POST">';
      echo '<input type="hidden" name="offre_id" value="' . $offre_id . '">';
      echo '<label for="nom">Nom :</label>';
      echo '<input type="text" name="nom" required><br>';
      echo '<label for="prenom">Prénom :</label>';
      echo '<input type="text" name="prenom" required><br>';
      echo '<label for="email">Email :</label>';
      echo '<input type="email" name="email" required><br>';
      echo '<input type="submit" value="Postuler">';
      echo '</form>';
    } else {
      echo 'Offre d\'emploi introuvable.';
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($connexion);
  } else {
    echo 'ID d\'offre d\'emploi non spécifié.';
  }
  ?>
</body>
</html>