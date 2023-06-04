<?php
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', 'Iamtheonewhoknocks');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styleListeContacts.css">
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

    <!-- Partie centrale -->
    <section id="communication-container">
        <div id="contacts">
            <div id="contacts-header">
                <h2>Vos contacts</h2>
            </div>
            <div id="contacts-list">
                <?php
                $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID != ?');
                $recupUser->execute(array($_SESSION['ID']));
                while ($user = $recupUser->fetch()) {
                ?>
                    <a href="message.php?ID=<?php echo $user['ID'] ?>">
                        <p><?php echo $user['nom'];
                            echo " ";
                            echo $user['prenom'];
                            echo " : ";
                            echo $user['email']; ?></p>
                    </a>
                <?php
                }
                ?>
            </div>
            <div id="select-user">
                <p>Sélectionnez l'utilisateur avec qui vous voulez parler</p>
            </div>
        </div>

    </section>


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