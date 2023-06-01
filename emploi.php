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
        <input type="submit" value="Soumettre ma candidature">
      
        <?php
        // Envoi d'une demande pour un emploi
        if (isset($_POST['envoyer_demande'])) {
        $offre_demande = $_SESSION['ID'];
        $utilisateur_demande = $_POST['destinataire_offre'];

        // Vérifier si une demande d'amitié existe déjà entre les deux utilisateurs
        $checkDemandeExist = $bdd->prepare('SELECT * FROM demande_emploi WHERE (id_auteur_offre = ? AND id_destinataire_offre = ?) OR (id_auteur_offre = ? AND id_destinataire_offre = ?)');
        $checkDemandeExist->execute(array($offre_demande, $utilisateur_demande, $utilisateur_demande, $offre_demande));

        if ($checkDemandeExist->rowCount() == 0) {
            // Insérer la demande d'amitié dans la base de données
            $insertDemande = $bdd->prepare('INSERT INTO demande_amis (id_auteur, id_destinataire, status) VALUES (?, ?, "en_attente")');
            $insertDemande->execute(array($auteur_demande, $destinataire_demande));

            echo "La demande d'amitié a été envoyée avec succès.";
        } else {
            echo "Une demande d'amitié entre ces deux utilisateurs existe déjà.";
        }
        }
        // Accepter une demande d'emploi
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
            ?>
</body>
</html>