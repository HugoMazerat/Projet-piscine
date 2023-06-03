<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: connexion.php");
    exit();
}

$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', '');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le contenu du post
    $postContent = $_POST['post-content'];

    // Récupérer le fichier de la photo du post
    $photoName = $_FILES['post-photo']['name'];
    $photoTmpName = $_FILES['post-photo']['tmp_name'];

    // Déplacer la photo vers le dossier de destination
    $destination = 'uploads/' . $photoName;
    move_uploaded_file($photoTmpName, $destination);

    // Récupérer les informations de l'utilisateur connecté
    $email = $_SESSION['email'];

    // Effectuer une requête SQL pour récupérer les autres informations de l'utilisateur (nom, prénom, photo) à partir de la table "utilisateurs"
    $userSql = "SELECT * FROM utilisateurs WHERE email = '$email'";
    $userResult = $bdd->query($userSql);
    $userData = $userResult->fetch();

    $userId = $userData['id'];

    // Insérer les informations du post dans la table "posts"
    $insertSql = "INSERT INTO posts (user_id, content, photo) VALUES ('$userId', '$postContent', '$destination')";
    $bdd->query($insertSql);

    // Rediriger vers la page d'accueil après avoir posté le contenu
    header("Location: accueil.php");
    exit();
}
?>
