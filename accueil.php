<?php
session_start();
$bdd = new PDO('mysql:host=localhost; dbname=pj1; charset=utf8', 'root', '72srmxqo');


$database = 'pj1';
$db_handle = mysqli_connect('localhost', 'root', '72srmxqo'); ///Changer MDP ----------------------------------------------
$database = 'pj1';


$database_author = 'pj1';//Permet de récupérer le nom de l'auteur à partir de son id 
$db_found= mysqli_select_db($db_handle, $database);

//if ($db_found) {
//
//    // Récupérer l'ID de l'utilisateur connecté à partir de la session
//    $user_id = $_SESSION['ID'];
//
//    // Récupérer les informations de l'utilisateur connecté
//    $recupUser = $bdd->prepare('SELECT * FROM personne WHERE ID = ?');
//    $recupUser->execute(array($user_id));
//
//    while ($user = $recupUser->fetch()) {
//        // Affichage des informations de l'utilisateur connecté
//        echo "<p class='bio'>" . $user['Prenom'] . " " . $user['Nom'] . "</p>";
//        echo "<p class='bio'>" . $user['Bio'] . "</p>";
//    }
//} else {
//    echo "<p>Database not found.</p>";
//}

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styleAccueil.css" rel="stylesheet">
    <title>ECEIn</title>
    
</head>

<body>

    <script type="text/javascript" language="javascript">

    function entrerPhoto(){
        nomPhoto = prompt("Entrer le nom du fichier que vous souhaitez publier.", "Mon Fichier");
        alert(nomPhoto);
        document.cookie = "nomPhoto = " + nomPhoto;//Permet de mettre dans les cookies du site la variable entrée
    }

    function entrerVideo(){
        nomVideo = prompt("Entrer le nom du fichier que vous souhaitez publier.", "Mon Fichier");
        alert(nomVideo);
        document.cookie = "nomVideo = " + nomVideo;//Permet de mettre dans les cookies du site la variable entrée
    }

    </script>

    <div class="top-header-nav">
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
            <a href="#Accueil">Accueil</a>
            <a href="MonReseau.php">Mon Reseau</a>
            <a href="vous.php" class="button bar-item">Vous</a>
            <a href="notifications.php">Notifications</a>
            <a href="#Messagerie">Messagerie</a>
            <a href="#Emplois">Emplois</a>
        </nav>

    </div>



    <!-- Colonne gauche -->
    <div class="row">

        <div class="column side"></div>

        <!-- Colonne milieu -->
        <div class="column middle">

            
            <div class="create-post">
                <div class="create-post-input">
                    <img src="yann.jpg">

                    <textarea rows="2" name="post" placeholder="Write a post"></textarea>
                </div>

                <div class="create-post-link">
                    <li><button onclick="entrerPhoto()"><img src="photo.png">Photo</button></li>
                    <li><button onclick="entrerVideo()"><img src="video.png">Vidéo</button></li>
                    <li><img src="evenement.png">Evenement</li>
                    <li>
                        <input id="post_button" type="submit" value="valider">
                        <?php

                        $image = $_COOKIE['nomPhoto'];
                        $video = $_COOKIE['nomVideo'];

                    
                        if (isset($_POST["valider"])) {
                            if ($db_found) {
                                //code MySQL. $sql est basé sur le choix de l’utilisateur
                                $sql = "INSERT INTO posts(image, video) VALUES('$image, $video')";
                                $result = mysqli_query($db_handle, $sql);
                                echo "<p>Add successful.</p>";
                            } else {
                                echo "<p>Database not found.</p>";
                            }
                        }
                        ?>
                    </li>

                </div>
            </div>

            <!-- -------------EXEMPLE DE CODE------------ -->
            <?php
                //$name= $_COOKIE['name'];
                //echo $name;
            ?>
            <!-- ---------------------------------------- -->



            <div class="post">
                <div class="post-author">
                    <?php

                    $recupUser = $bdd->prepare('SELECT * FROM posts');
                   // $recupUser->execute(array($_SESSION['ID']));
                

                   //Ci-dessous afficher le nom de l'auteur du post, son prenom et sa photo.

                   // if ($db_found) {
//
//
                   //     //afficher le resultat
                   //     while ($user = $recupUser->fetch()) {
//
                   //         //Affichage du nom, prenom + photo de l'auteur. Je pense qu'il va falloir faire un lien avec la table dans linkedin, donc pourquoi pas la recréer dans pj1
                   //     }
                   // } else {
                   //     echo "<p>Database not found.</p>";
                   // }

 
                    ?>
                    
                    <div>

 
 
                        <?php  

                        $recupUser = $bdd->prepare('SELECT * FROM posts where id != ?');
                        $recupUser->execute(array($_SESSION['ID']));
                        if ($db_found) {


                            //afficher le resultat
                            while ($user = $recupUser->fetch()) {

                                //Affichage de la bio entrée par la personne
                                echo "<small class='date'>" . $user['date'] . "</small>";
                                
                                $image = $user['image'];
                                echo "<img src='$image'>";

                                echo "<p>" . $user['post'] ."</p>";
                            }
                        } else {
                            echo "<p>Database not found.</p>";
                        }


                        ?>

                       <!-- <small>2 hours ago</small>-->
                    </div>
                </div>

               <!-- <img src="L1000680.jpg" width="100%">

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sit amet pretium urna. Vivamus
                    venenatis velit nec neque ultricies, eget elementum magna tristique. Quisque vehicula, risus eget
                    aliquam placerat, purus leo tincidunt eros, eget luctus quam orci in velit. Praesent scelerisque
                    tortor sed accumsan convallis.
                </p>-->
            </div>






        </div>

        <!-- Colonne droite -->
        <div class="column side"></div>
    </div>








</body>

</html>