<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=linkedin;charset=utf8', 'root', ''); // Connexion à la base de données

if(isset($_POST['valider'])) {
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
        $recupUser->execute(array($email));

        if($recupUser->rowCount() > 0) {
            $user = $recupUser->fetch();

            // Vérification du mot de passe
            if($password === $user['password']) { // Remplacez 'mdp' par le nom réel de la colonne contenant le mot de passe dans votre base de données
                $_SESSION['email'] = $email;
                $_SESSION['ID'] = $user['ID'];
                header('Location: accueil.php');
                exit;
            } else {
                echo "Mot de passe incorrect";
            }
        } else {
            echo "Aucun utilisateur trouvé";
        }
    } else {
        echo "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Page de connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styleConnexion.css">
    </head>

    <body>
        <section>
            <h1>Connexion</h1>
            <form method="POST" action="" align="center">
                <input type="text" name="email" placeholder="Email">
                <br/>
                <input type="password" name="password" placeholder="Mot de passe">
                <br/>
                <input type="submit" name="valider">
            </form>
        </section>
    </body>
</html>
