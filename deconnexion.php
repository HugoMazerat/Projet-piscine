<?php
session_start(); // démarrage session
$_SESSION = array();
session_destroy(); // déco de la BDD
header('Location: connexion.php'); // redirection vers la connexion
?>