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
        
        <h2>Offres d'emploi disponibles</h2>
        <?php include 'Offres_disponibles.php'; ?>
     
</body>
</html>