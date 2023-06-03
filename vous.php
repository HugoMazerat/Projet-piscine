<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styleVous.css" rel="stylesheet">
    <title>ECEIn/Vous</title>
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
        <a href="accueil.html">Accueil</a>
        <a href="monReseau.php">Mon Reseau</a>
        <a href="vous.php" class="button bar-item">Vous</a>
        <a href="notifications.php">Notifications</a>
        <a href="listeContacts.php">Messagerie</a>
        <a href="emploi.php">Emplois</a>
    </nav>

    <div class="container">
        <div class="profile-main">
            <div class="profile-container">
                <div class="profile-container-inner">

                    <!-- <form action="donnesVous.php" method="post">
                            <p>ici</p>
                        </form>-->

                    <!--Les lignes suivantes servent à tester le css et devront être enlevées-->
                    <!--<img src="L1000662.JPG" class="profile-pic">
                        <h1>Hugo Mazerat</h1>
                        <p>Je code des sites</p>-->


                    <?php

                    $bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', '');
                    session_start();

                    $database = 'linkedin';
                    $db_handle = mysqli_connect('localhost', 'root', ''); ///Changer MDP ----------------------------------------------
                    $db_found = mysqli_select_db($db_handle, $database);

                    if ($db_found) {

                        
                        if (isset($_GET['ID'])) {
                            $_SESSION['ID'] = $_GET['ID'];
                        }

                        // Récupérer l'ID de l'utilisateur connecté à partir de la session
                        $user_id = $_SESSION['ID'];
                        

                        // Récupérer les informations de l'utilisateur connecté
                        $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID = ?');
                        $recupUser->execute(array($user_id));

                        while ($user = $recupUser->fetch()) {
                            // Affichage des informations de l'utilisateur connecté
                            echo "<p class='bio'>" . $user['prenom'] . " " . $user['nom'] . "</p>";
                        }
                    } else {
                        echo "<p>Database not found.</p>";
                    }

                    ?>
                </div>
            </div>
        </div>

        <div class="profile-description">
            <h2>Description</h2>

            <?php

            $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID = ?');
            $recupUser->execute(array($_SESSION['ID']));
            if ($db_found) {


                //afficher le resultat
                while ($user = $recupUser->fetch()) {

                    //Affichage de la bio entrée par la personne

                    echo "<p class='bio'>" . $user['Bio'] . "</p>";
                }
            } else {
                echo "<p>Database not found.</p>";
            }


            ?>
        </div>

        <div class="profile-experience">
            <h2>Expérience</h2>
            <?php

            $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID = ?');
            $recupUser->execute(array($_SESSION['ID']));

            if ($db_found) {


                //afficher le resultat
                while ($user = $recupUser->fetch()) {

                    //Affichage de l'expérience entrée par la personne

                    echo "<p class='experience'>" . $user['Projets'] . "</p>";
                }
            } else {
                echo "<p>Database not found.</p>";
            }


            ?>
        </div>


        <div class="profile-stages">
            <h2>Stages</h2>

            <?php

            $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID = ?');
            $recupUser->execute(array($_SESSION['ID']));
            if ($db_found) {


                //afficher le resultat
                while ($user = $recupUser->fetch()) {

                    //Affichage de la bio entrée par la personne

                    echo "<p class='stages'>" . $user['stages'] . "</p>";
                }
            } else {
                echo "<p>Database not found.</p>";
            }


            ?>
        </div>


        <div class="profile-Formation">
            <h2>Formations</h2>

            <?php

            $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID = ?');
            $recupUser->execute(array($_SESSION['ID']));
            if ($db_found) {


                //afficher le resultat
                while ($user = $recupUser->fetch()) {

                    //Affichage de la bio entrée par la personne

                    echo "<p class='Formation'>" . $user['Formation'] . "</p>";
                }
            } else {
                echo "<p>Database not found.</p>";
            }


            ?>
        </div>


        <!--<hr>-->
        <div class="profile-sidebar">
            <h2>Modifier votre profil</h2>
            <p>Pour compléter votre profil ou le modifier, <a href="jiji.html">cliquez ici.</a></p>
        </div>
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

</body>

</html>