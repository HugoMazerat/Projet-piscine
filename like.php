<?php
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', '');

// Récupérer l'ID de l'utilisateur connecté
$userID = $_SESSION['ID'];

// Vérifier si le paramètre postID est présent dans l'URL
if (isset($_GET['postID'])) {
    $postID = $_GET['postID'];

    // Vérifier si l'utilisateur a déjà aimé le post
    $sqlCheckLike = "SELECT COUNT(*) AS count FROM likes WHERE post_id = $postID AND user_id = $userID";
    $checkLikeResult = $bdd->query($sqlCheckLike);
    $hasLiked = $checkLikeResult->fetch()['count'] > 0;

    if (!$hasLiked) {
        // Ajouter le like dans la base de données
        $sqlAddLike = "INSERT INTO likes (post_id, user_id) VALUES ($postID, $userID)";
        $bdd->exec($sqlAddLike);
    }
}

// Rediriger l'utilisateur vers la page d'accueil ou une autre page appropriée
header("Location: accueil.php");
exit();
?>
