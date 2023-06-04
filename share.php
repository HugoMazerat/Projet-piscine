<?php
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', '');

// Récupérer l'ID de l'utilisateur connecté
$userID = $_SESSION['ID'];

// Vérifier si le paramètre postID est présent dans l'URL
if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];

    // Vérifier si l'utilisateur a déjà partagé le post
    $sqlCheckShare = "SELECT COUNT(*) AS count FROM shares WHERE post_id = $postID AND user_id = $userID";
    $checkShareResult = $bdd->query($sqlCheckShare);
    $hasShared = $checkShareResult->fetch()['count'] > 0;

    if (!$hasShared) {
        // Ajouter le partage dans la base de données
        $sqlAddShare = "INSERT INTO shares (post_id, user_id) VALUES ($postID, $userID)";
        $bdd->exec($sqlAddShare);
    }
}

// Rediriger l'utilisateur vers la page d'accueil ou une autre page appropriée
header("Location: accueil.php");
exit();
?>
