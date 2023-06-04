<?php
session_start(); // démarrage de la session

if (!isset($_SESSION['ID'])) { // on vérif si l'utilisateur est connecté
    header("Location: connexion.php"); //on regirige vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', ''); // connexion à la BDD

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // on vérif si le formulaire est soumis

    $postContenu = $_POST['post-content'];// on récup le contenu texte du post

    $photoName = $_FILES['post-photo']['name']; // récup la photo du post
    $photoTmpName = $_FILES['post-photo']['tmp_name']; // temporaire

    $destination = 'uploads/' . $photoName;
    move_uploaded_file($photoTmpName, $destination); // on déplace la photo vers le dossier destination


    $user_ID = $_SESSION['ID']; // réccup l'ID de l'utilisateur co

    //  sql pour récupérer les informations de l'utilisateur co
    $userSql = "SELECT * FROM utilisateurs WHERE ID = '$user_ID'";
    $userResult = $bdd->query($userSql);
    $userData = $userResult->fetch();
    $user_ID = $userData['ID'];

    $insertSql = "INSERT INTO posts (user_id, content, photo) VALUES ('$user_ID', '$postContenu', '$destination')"; // on insert les infos du post 
    $bdd->query($insertSql);

    $postId = $bdd->lastInsertId(); 
    $usersSql = "SELECT * FROM utilisateurs WHERE ID != '$user_ID'"; // requet SQl pour sélecionner tous les utilisateurs sauf celui connecté pour enovyer une notif
    $usersResult = $bdd->query($usersSql);

    if ($usersResult) {
        while ($userData = $usersResult->fetch()) { 
            $notificationUserId = $userData['ID'];
            // on insert les informations de la notification 
            $insertNotificationSql = "INSERT IGNORE INTO notifications (user_id, post_id, contenu, auteur_prenom, auteur_nom) VALUES ('$notificationUserId', '$postId', '$postContenu', '{$userData['nom']}', '{$userData['prenom']}')";
            $bdd->query($insertNotificationSql);
        }
    }
    header("Location: accueil.php"); // on redirige à l'accueil
    exit();
}
