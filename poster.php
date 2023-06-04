<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID'])) {
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
    $userID = $_SESSION['ID'];

    // Effectuer une requête SQL pour récupérer les autres informations de l'utilisateur (nom, prénom, photo) à partir de la table "utilisateurs"
    $userSql = "SELECT * FROM utilisateurs WHERE ID = '$userID'";
    $userResult = $bdd->query($userSql);
    $userData = $userResult->fetch();

    $userId = $userData['ID'];

    // Insérer les informations du post dans la table "posts"
    $insertSql = "INSERT INTO posts (user_id, content, photo) VALUES ('$userId', '$postContent', '$destination')";
    $bdd->query($insertSql);

    // Récupérer l'ID du post nouvellement inséré
    $postId = $bdd->lastInsertId();

    // Sélectionner tous les utilisateurs (excepté l'utilisateur actuel) pour envoyer la notification
    $usersSql = "SELECT * FROM utilisateurs WHERE ID != '$userId'";
    $usersResult = $bdd->query($usersSql);

    // Vérifier si des utilisateurs ont été sélectionnés
    if ($usersResult) {
        // Parcourir les utilisateurs et envoyer une notification à chacun
        while ($userData = $usersResult->fetch()) {
            $notificationUserId = $userData['ID'];

            // Insérer les informations de la notification dans la table "notifications" en ignorant les duplicatas
            $insertNotificationSql = "INSERT IGNORE INTO notifications (user_id, post_id, content, author_name, author_lastname) VALUES ('$notificationUserId', '$postId', '$postContent', '{$userData['nom']}', '{$userData['prenom']}')";
            $bdd->query($insertNotificationSql);
        }
    }

    // Rediriger vers la page d'accueil après avoir posté le contenu
    header("Location: accueil.php");
    exit();
}
