<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données du formulaire
  $titre = $_POST['titre'];
  $descriptions = $_POST['description'];

  // Connexion à la base de données
  $connexion = mysqli_connect('localhost', 'root', '', 'linkedin');
  if (!$connexion) {
    die('Erreur de connexion à la base de données');
  }

  // Récupérer l'ID de l'utilisateur actuellement connecté (vous devez le gérer dans votre système d'authentification)
  $utilisateur_id = 1; // Remplacez par votre propre logique pour récupérer l'ID de l'utilisateur connecté

  // Insertion de l'offre d'emploi dans la base de données avec l'ID de l'utilisateur connecté
  $query = "INSERT INTO offres_emploi (titre, descriptions, utilisateur_id) VALUES ('$titre', '$descriptions', '$utilisateur_id')";
  $result = mysqli_query($connexion, $query);

  if ($result) {
    echo 'L\'offre d\'emploi a été créée avec succès.';
  } else {
    echo 'Erreur lors de la création de l\'offre d\'emploi : ' . mysqli_error($connexion);
  }

  // Fermeture de la connexion à la base de données
  mysqli_close($connexion);
}
?>