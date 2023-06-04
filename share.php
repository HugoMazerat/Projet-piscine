<?php
session_start(); // démarrage de la session
$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', ''); // Connexion à la base de données

$user_ID = $_SESSION['ID']; // on récup l'ID de l'utilisateur connecté

if (isset($_GET['postID'])) {
    $postID = $_GET['postID']; // on récup postID dans l'ID

    $sqlCheckShare = "SELECT COUNT(*) AS count FROM shares WHERE post_id = $postID AND user_id = $userID"; // requete SQl pour voir si l'utilisateur a déjà partagé le post
    $checkShareResult = $bdd->query($sqlCheckShare);
    $hasShared = $checkShareResult->fetch()['count'] > 0;

    if (!$hasShared) {
        $sqlAddShare = "INSERT INTO shares (post_id, user_id) VALUES ($postID, $userID)"; // ajout du partage dans la base de données
        $bdd->exec($sqlAddShare);
    }
}

header("Location: accueil.php"); // on redirige l'utilisateur vers la page d'accueil
exit();
?>
