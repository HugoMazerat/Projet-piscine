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




    <!-- Colonne gauche -->
    <div class="row">

        <div class="column side"></div>

        <!-- Colonne milieu -->
        <div class="column middle">

            <!-- Poster / Voir les posts -->
            <section id="create-post">
                <div class="create-post">
                    <div class="create-post-input ">
                        <form action="poster.php" method="post" enctype="multipart/form-data">
                            <textarea name="post-content" placeholder="Entrez votre texte ici"></textarea>
                    </div>
                    <div class="create-post-link">
                        <li>
                            <div class="create-post-link-fichier"><img src="photo.png"><input type="file"
                                    name="post-photo"></div>
                        </li>
                        <li><input type="submit" value="Poster" class="form-post-button"></li>
                    </div>

                    </form>

                </div>
            </section>
            <br>





            <!-- Afficher les posts -->
            <section id="posts">
                <?php
                session_start(); // démarrer la session
                $bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', ''); // connexion à la BDD

                $userID = $_SESSION['ID']; // récup l'ID de l'utilisateur 

                $sqlAmis = "SELECT id_u2 FROM amis WHERE id_u1 = $userID"; // requete -> récup la liste des amis
                $resultAmis = $bdd->query($sqlAmis);
                $amis = [];
                while ($rowAmis = $resultAmis->fetch()) {
                    $amis[] = $rowAmis['id_u2'];
                }


                $amis[] = $userID;

                
                $amisStr = implode(',', $amis); // conversion liste  amis -> chaine pour l'utiliser en requete sql 

                // requete sql recup les post
                $sqlPosts = "SELECT p.id, p.content, p.photo, p.created_at, u.nom, u.prenom FROM posts p INNER JOIN utilisateurs u ON p.user_id = u.ID WHERE p.user_id IN ($amisStr) OR p.id IN (SELECT post_id FROM shares WHERE user_id IN ($amisStr))";
                $result = $bdd->query($sqlPosts);

                // affichage des posts
                while ($row = $result->fetch()) {

                    $postId = $row['id'];
                    $postContent = $row['content'];
                    $postPhoto = $row['photo'];
                    $postCreatedAt = $row['created_at'];
                    $postUserNom = $row['nom'];
                    $postUserPrenom = $row['prenom'];

                    // recup likes pour le post
                    $sqlLikes = "SELECT COUNT(*) AS count FROM likes WHERE post_id = $postId";
                    $likesResult = $bdd->query($sqlLikes);
                    $likesCount = $likesResult->fetch()['count'];

                    //verif like post
                    $sqlCheckLike = "SELECT COUNT(*) AS count FROM likes WHERE post_id = $postId AND user_id = $userID";
                    $checkLikeResult = $bdd->query($sqlCheckLike);
                    $hasLiked = $checkLikeResult->fetch()['count'] > 0;

                    // recup pour le post
                    $sqlShares = "SELECT COUNT(*) AS count FROM shares WHERE post_id = $postId";
                    $sharesResult = $bdd->query($sqlShares);
                    $sharesCount = $sharesResult->fetch()['count'];

                    // vérif partage le post
                    $sqlCheckShare = "SELECT COUNT(*) AS count FROM shares WHERE post_id = $postId AND user_id = $userID";
                    $checkShareResult = $bdd->query($sqlCheckShare);
                    $hasShared = $checkShareResult->fetch()['count'] > 0;
                    ?>


                    <div class="post">
                        <div class="post-author">
                            <h1>
                                <?php echo $postUserPrenom . ' ' . $postUserNom;
                                ?>
                            </h1>

                        </div>
                        <p>
                            <?php echo " ";
                            echo " le : ";
                            echo $postCreatedAt; ?>
                        </p>


                        <?php
                        echo '<div class="post-content">';
                        echo '<p>' . $postContent . '</p>';
                        if (!empty($postPhoto)) {
                            echo '<img src="' . $postPhoto . '" alt="Photo du post">';
                        }
                        echo '</div>'; ?>


                        <div class="post-like-share">
                            <li>
                                <div class="create-post-link-fichier">
                                    <?php if (!$hasLiked) {
                                        echo '<a href="like.php?postID=' . $postId . '">Like</a>';
                                    } else {
                                        echo '<span>Vous avez déjà liké ce post</span>';
                                    }
                                    echo '<span> Likes: ' . $likesCount . '</span>'; ?>
                                </div>
                            </li>
                            <li>
                                <div class="create-post-link-fichier">
                                    <?php if (!$hasShared) {
                                        echo '<a href="share.php?postID=' . $postId . '">Share</a>';
                                    } else {
                                        echo '<span>Vous avez déjà partagé ce post</span>';
                                    }
                                    echo '<span>Partages: ' . $sharesCount . '</span>'; ?>
                                </div>
                            </li>
                        </div>

                        <?php



                }
                ?>


            </section>

        </div>

        <!-- Colonne droite -->
        <div class="column side"></div>
    </div>



    <!-- Footer -->
    <footer>
        <h3> Contacts :</h3><br />
        <u>(+33) 06 05 04 03 02</u><br />
        <a href="mailto:ecein-contact@gmail.com"> ecein-contact@gmail.com </a><br />
        <address>59 avenue Victor Hugo, 75016 Paris</address><br />
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.366109623976!2d2.285990976777601!3d48.851228701210104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Engineering%20school.!5e0!3m2!1sfr!2sfr!4v1685352343811!5m2!1sfr!2sfr"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

        <p>
            Droits d'auteur | Copyright © 2023, ECEIn corporation, Paris
        </p>
    </footer>

</body>

</html>