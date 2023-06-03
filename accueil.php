<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styleAccueil.css" rel="stylesheet">
    <title>ECEIn</title>
</head>

<body>

    <!-- Band Description -->
    <header>
        <div class="header_droite">
            <img class="logo" src="Logo.png">
        </div>

        <div class="header_gauche">
            <h2> ECE In: Social Media Professionnel de l'ECE Paris</h2>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="topnav">
        <a href="accueil.php">Accueil</a>
        <a href="monReseau.php">Mon Réseau</a>
        <a href="vous.php" class="button bar-item">Vous</a>
        <a href="notifications.php">Notifications</a>
        <a href="listeContacts.php">Messagerie</a>
        <a href="emploi.php">Emplois</a>
    </nav>

    <!-- Poster / Voir les posts -->
    <section id="create-post">
        <h2>Créer un post</h2>
        <form action="poster.php" method="post" enctype="multipart/form-data">
            <textarea name="post-content" placeholder="Entrez votre texte ici"></textarea>
            <input type="file" name="post-photo">
            <input type="submit" value="Poster">
        </form>
    </section>

    <!-- Afficher les posts -->
    <section id="posts">
        <?php
        session_start();
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', '');

        // Récupérer les informations des posts à partir de la table "posts"
        $sql = "SELECT * FROM posts";

        //$sql = "SELECT posts.*, utilisateurs.nom, utilisateurs.prenom FROM posts
        //INNER JOIN utilisateurs ON posts.user_id = utilisateurs.ID
        //ORDER BY posts.created_at DESC";

        $result = $bdd->query($sql);

        // Afficher les posts
        while ($row = $result->fetch()) {
            $postId = $row['id'];
            $postContent = $row['content'];
            $postPhoto = $row['photo'];
            $postCreatedAt = $row['created_at'];
            //$postUserNom = $row['nom'];
            //$postUserPrenom = $row['prenom'];
            //$postUserPhoto = $row['Photo'];

            echo '<div class="post">';
            //echo '<div class="post-user">';
            //echo '<img src="' . $postUserPhoto . '" alt="Photo utilisateur">';
            //echo '<h3>' . $postUserPrenom . ' ' . $postUserNom . '</h3>';
            //echo '</div>';
            echo '<div class="post-content">';
            echo '<p>' . $postContent . '</p>';
            if (!empty($postPhoto)) {
                echo '<img src="' . $postPhoto . '" alt="Photo du post">';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>
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