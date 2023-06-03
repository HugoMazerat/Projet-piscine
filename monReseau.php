<?php
session_start(); // Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', 'Iamtheonewhoknocks');
?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styleMonReseau.css">
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
        <a href="vous.php" class="button bar-item">Vous</a>
        <a href="notifications.php">Notifications</a>
        <a href="listeContacts.php">Messagerie</a>
        <a href="#Emplois">Emplois</a>
    </nav>



    <?php


    // Envoi d'une demande d'amitié
    if (isset($_POST['envoyer_demande'])) {
        $auteur_demande = $_SESSION['ID'];
        $destinataire_demande = $_POST['destinataire'];

        // Vérifier si une demande d'amitié existe déjà entre les deux utilisateurs
        $checkDemandeExist = $bdd->prepare('SELECT * FROM demande_amis WHERE (id_auteur = ? AND id_destinataire = ?) OR (id_auteur = ? AND id_destinataire = ?)');
        $checkDemandeExist->execute(array($auteur_demande, $destinataire_demande, $destinataire_demande, $auteur_demande));

        if ($checkDemandeExist->rowCount() == 0) {
            // Insérer la demande d'amitié dans la base de données
            $insertDemande = $bdd->prepare('INSERT INTO demande_amis (id_auteur, id_destinataire, status) VALUES (?, ?, "en_attente")');
            $insertDemande->execute(array($auteur_demande, $destinataire_demande));

            echo "La demande d'amitié a été envoyée avec succès.";
        } else {
            echo "Une demande d'amitié entre ces deux utilisateurs existe déjà.";
        }
    }

    // Accepter une demande d'amitié
    if (isset($_POST['accepter_demande'])) {
        $id_demande = $_POST['id_demande'];

        // Mettre à jour le statut de la demande d'amitié pour l'accepter
        $updateDemande = $bdd->prepare('UPDATE demande_amis SET status = "accepté" WHERE id = ?');
        $updateDemande->execute(array($id_demande));

        // Récupérer les ID de l'auteur de la demande et du destinataire
        $recupIDs = $bdd->prepare('SELECT id_auteur, id_destinataire FROM demande_amis WHERE id = ?');
        $recupIDs->execute(array($id_demande));
        $ids = $recupIDs->fetch();

        $auteur_demande = $ids['id_auteur'];
        $destinataire_demande = $ids['id_destinataire'];

        // Insérer une nouvelle entrée dans la table "amis"
        $insertAmi = $bdd->prepare('INSERT INTO amis (id_u1, id_u2) VALUES (?, ?)');
        $insertAmi->execute(array($auteur_demande, $destinataire_demande));

        echo "La demande d'amitié a été acceptée.";
    }



    // Récupérer la liste des utilisateurs, à l'exception de l'utilisateur actuel
    $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID != ?');
    $recupUser->execute(array($_SESSION['ID']));
    ?>
    <!-- Partie centrale -->
    <section id="communication-container">
        <div id="contacts">
            <div id="contacts-header">
                <h2>Les utilisateurs d'EceIn</h2>
            </div>
            <div id="contacts-list">
                <?php while ($user = $recupUser->fetch()) { ?>
                    <p>
                        <?php echo $user['nom'];
                        echo " ";
                        echo $user['prenom'];
                        echo " : ";
                        echo $user['email']; ?>

                    <div class="row">
                        
                        <div class="column side">
                            <div class="profile-box">
                                <img src="fond.jpg">
                                <div class="profil-info">
                                    <img src="<?php echo $user['Photo'];?>"  width="30px">
                                    <h1>
                                        <?php echo $user['nom'];
                                        echo " ";
                                        echo $user['prenom'];
                                        echo " : ";
                                        echo $user['email']; ?>
                                    </h1>
                                    <h3>
                                        <?php
                                        echo $user['Bio'];
                                        ?>
                                    </h3>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire pour envoyer une demande d'amitié -->
                    <form method="post" action="">
                        <input type="hidden" name="destinataire" value="<?php echo $user['ID']; ?>">
                        <button type="submit" name="envoyer_demande">Envoyer demande d'amitié</button>
                    </form>
                    </p>
                <?php } ?>
            </div>
            <div id="select-user">
                <p>Sélectionnez l'utilisateur à qui vous voulez envoyer une demande d'amitié</p>
            </div>
        </div>
        <!-- Section pour afficher les demandes d'amitié reçues -->
        <section id="demandes-amis">
            <h2>Demandes d'amitié reçues</h2>
            <?php
            // Récupérer les demandes d'amitié reçues par l'utilisateur actuel
            $recupDemandes = $bdd->prepare('SELECT demande_amis.*, utilisateurs.nom, utilisateurs.prenom FROM demande_amis INNER JOIN utilisateurs ON demande_amis.id_auteur = utilisateurs.ID WHERE id_destinataire = ? AND status = "en_attente"');
            $recupDemandes->execute(array($_SESSION['ID']));

            while ($demande = $recupDemandes->fetch()) {
                ?>
                <div class="demande">
                    <p>
                        <?php echo $demande['nom'];
                        echo " ";
                        echo $demande['prenom']; ?> souhaite devenir votre ami(e).
                    </p>
                    <!-- Formulaire pour accepter la demande d'amitié -->
                    <form method="post" action="">
                        <input type="hidden" name="id_demande" value="<?php echo $demande['id']; ?>">
                        <button type="submit" name="accepter_demande">Accepter la demande</button>
                    </form>
                </div>
                <?php
            }
            ?>
        </section>



        <!-- Section pour afficher la liste des amis -->
        <section id="liste-amis">
            <h2>Mes amis</h2>
            <?php
            // Récupérer la liste des amis de l'utilisateur actuel
            $recupAmis = $bdd->prepare('SELECT utilisateurs.nom, utilisateurs.prenom FROM utilisateurs INNER JOIN amis ON utilisateurs.ID = amis.id_u1 OR utilisateurs.ID = amis.id_u2 WHERE (amis.id_u1 = ? OR amis.id_u2 = ?) AND utilisateurs.ID != ?');
            $recupAmis->execute(array($_SESSION['ID'], $_SESSION['ID'], $_SESSION['ID']));

            while ($ami = $recupAmis->fetch()) {
                ?>
                <p>
                    <?php echo $ami['nom'];
                    echo " ";
                    echo $ami['prenom']; ?>
                </p>
                <?php
            }
            ?>
        </section>

    </section>











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