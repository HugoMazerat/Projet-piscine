<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="styleEmploi.css" rel="stylesheet">
  <title>ECEIn</title>

</head>

<body>

  <!-- Band Description -->
  <header>

    <div class="header_droite ">
      <img class="logo" src="Logo.png">
    </div>

    <div class="header_gauche ">
      <h2> ECE In: Social Media Professionnel de l'ECE Paris</h2>
    </div>


  </header>



  <!-- Navigation -->
  <nav class="topnav">
    <a href="accueil.php">Accueil</a>
    <a href="monReseau.php">Mon Reseau</a>
    <a href="vous.php" class="button bar-item">Vous</a>
    <a href="notifications.php">Notifications</a>
    <a href="listeContacts.php">Messagerie</a>
    <a href="emploi.php">Emplois</a>
  </nav>

  <!--  Emploi -->
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



  <!-- Footer -->
  <footer>


    <h3> Contacts :</h3><br />
    <u>(+33) 06 05 04 03 02</u><br />
    <a href="mailto:ecein-contact@gmail.com"> ecein-contact@gmail.com </a><br />
    <address>59 avenue Victor Hugo, 75016 Paris</address><br />
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.366109623976!2d2.285990976777601!3d48.851228701210104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685352343811!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    <p>
      Droits d'auteur | Copyright © 2023, ECEIn corporation, Paris
    </p>


  </footer>

</body>

</html>