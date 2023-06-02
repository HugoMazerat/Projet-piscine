<?php
session_start();
$_SESSION = array();
session_destroy(); // Déconnexion à la base de données
header('Location: connexion.php');
?>