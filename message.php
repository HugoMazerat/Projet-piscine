<?php
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=pj1;charset=utf8', 'root', '');
if (!$_SESSION['email']) {
    header('Location: connexion.php');
}

if (isset($_GET['ID']) and !empty($_GET['ID'])) {

    $getid = $_GET['ID'];
    $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID = ?');
    $recupUser->execute(array($getid));
    if ($recupUser->rowCount() > 0) {
        if (isset($_POST['envoyer'])) {
            $message = htmlspecialchars($_POST['message']);
            $id_auteur = isset($_SESSION['ID']) ? $_SESSION['ID'] : null; // Vérification de $_SESSION['ID']
            $insererMessage = $bdd->prepare('INSERT INTO message(message, id_destinataire, id_auteur)VALUES(?, ?, ?)');
            $insererMessage->execute(array($message, $getid, $_SESSION['ID']));
        }
    } else {
        echo " Aucun utilisateur trouvé";
    }
} else {
    echo " Aucun identifiant trouvé";
}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styleMessage.css">
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
        <a href="accueil.html">Accueil</a>
        <a href="monReseau.php">Mon Reseau</a>
        <a href="#Vous" class="button bar-item">Vous</a>
        <a href="notifications.php">Notifications</a>
        <a href="listeContacts.php">Messagerie</a>
        <a href="#Emplois">Emplois</a>
    </nav>

    <!-- Partie centrale -->

    <!-- Espace général dédié à la page de communication -->
    <div id="communication-container">

        <!-- Première partie : Nom, prénom et email de l'utilisateur -->
        <div id="user-info">
            <?php
            // Code pour récupérer et afficher le nom, prénom et email de l'utilisateur
            $recupUser = $bdd->prepare('SELECT nom, prenom, email FROM utilisateurs WHERE ID = ?');
            $recupUser->execute(array($getid));
            $userInfo = $recupUser->fetch();
            echo "<span>" . $userInfo['nom'] . "</span>&nbsp;";
            echo "<span>" . $userInfo['prenom'] . "</span>";
            echo "<p>email: " . $userInfo['email'] . "</p>";
            ?>
        </div>


        <!-- Deuxième partie : Messages échangés avec l'utilisateur -->
        <section id="messages" class="message-container">
            <?php
            $recupMessages = $bdd->prepare('SELECT * FROM message WHERE (id_auteur = ? AND id_destinataire = ?) OR (id_auteur = ? AND id_destinataire = ?)');
            $recupMessages->execute(array($_SESSION['ID'], $getid, $getid, $_SESSION['ID']));
            while ($message = $recupMessages->fetch()) {
                if ($message['id_destinataire'] == $_SESSION['ID']) {
            ?>
                    <p class="received-message"><?= $message['message']; ?></p>
                <?php
                } elseif ($message['id_destinataire'] == $getid) {
                ?>
                    <p class="sent-message"><?= $message['message']; ?></p>
            <?php
                }
            }
            ?>
        </section>

        <!-- Troisième partie : Formulaire pour écrire un message -->
        <form method="POST" action="">
            <textarea name="message"></textarea>
            <br /><br />
            <input type="submit" name="envoyer">
        </form>

    </div>



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

    <script>
        var messageContainer = document.getElementById("messages");
        messageContainer.scrollTop = messageContainer.scrollHeight;
    </script>

</body>

</html>