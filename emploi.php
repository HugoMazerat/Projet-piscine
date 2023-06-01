<!DOCTYPE html>
<html>
<head>
    <title>Alerte Emploi</title>
</head>
<body>
    <h1>Alerte Emploi</h1>
    
        <h2 class="Nom">Nom de l'emploi :</h2>
        <input type="text" name="Nom" id="Nom" required>
        <br>
        <h2 class="Type">Type de contrat :</h2>
        <input type="text" name="Type" id="Type">
        <br>
        <h2 class="Salaire">Salaires :</h2>
        <input type="text" name="Salaire" id="Salaire">
        <br>
        <br>
        <h2 class="Entreprise">Entreprise d'accueil :</h2>
        <input type="text" name="entreprise" id="Entreprise">
        <br>
        <input type="submit" value="Soumettre ma candidature" name ="candidature">
        <!--Il faudra créer un bouton pour accepter les demandes d'emploi avec en name accepter_demande-->
        <?php

        $bdd = new PDO('mysql:host=localhost;dbname=pj1;chzrset=utf8', 'root', 'Gabi2002!');
        // Envoi d'une demande pour un emploi
        if (isset($_POST['candidature'])) {
        $offre_demande = $_SESSION['ID'];
        $utilisateur_demande = $_POST['ID_destinatire_offre'];

        // Vérifier si une demande d'emploi existe déjà pour cette offre
        $checkDemandeExist = $bdd->prepare('SELECT * FROM demande_emploi WHERE (ID_auteur_offre = ? AND ID_destinatire_offre = ?) OR (ID_auteur_offre = ? AND ID_destinataire_offre = ?)');
        $checkDemandeExist->execute(array($offre_demande, $utilisateur_demande, $utilisateur_demande, $offre_demande));

        if ($checkDemandeExist->rowCount() == 0) {
            // Insérer la demande d'emploi dans la base de données
            $insertDemande = $bdd->prepare('INSERT INTO demande_emplois (ID_auteur_offre, ID_destinataire_offr, status) VALUES (?, ?, "en_attente")');
            $insertDemande->execute(array($offre_demande, $utilisateur_demande));

            echo "La demande d'emploi a été envoyée avec succès.";
        } else {
            echo "Une demande d'emploi a déjà été réalisé.";
        }
        }
        // Accepter une demande d'emploi
         if (isset($_POST['accepter_demande'])) {
             $id_demande = $_POST['ID'];

            // Mettre à jour le statut de la demande d'amitié pour l'accepter
             $updateDemande = $bdd->prepare('UPDATE demande_emploi SET status = "accepté" WHERE ID = ?');
             $updateDemande->execute(array($id_demande));

            // Récupérer les ID de l'auteur de la demande et du destinataire
             $recupIDs = $bdd->prepare('SELECT ID_auteur_offre, ID_destinataire_offre FROM demande_emploi WHERE ID = ?');
             $recupIDs->execute(array($id_demande));
             $ids = $recupIDs->fetch();

             $auteur_demande = $ids['ID_auteur_offre'];
             $destinataire_demande = $ids['ID_destinataire_offre'];

            // Insérer une nouvelle entrée dans la table "amis"
             $insertAmi = $bdd->prepare('INSERT INTO offre_emploi (Postulant, Offre_id) VALUES (?, ?)');
             $insertAmi->execute(array($auteur_demande, $destinataire_demande));

            echo "La demande d'emploi²   a été acceptée.";
            } 
            ?>
</body>
</html>