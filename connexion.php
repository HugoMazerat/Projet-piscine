<?php 
session_start();
$bdd = new PDO('mysql:host=localhost; dbname=pj1; charset=utf8;', 'root', '');
if(isset ($_POST ['valider'])){
    if(!empty($_POST['email'])){
        $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = ?');
        $recupUser->execute(array($_POST['email']));

        if($recupUser->rowCount() > 0){

            $_SESSION['email'] = $_POST['email'];
            $_SESSION['ID'] = $recupUser->fetch()['ID'];
            header('Location: accueil.html');
        }else{
            echo "Aucun utilisateur trouvé";
        }
    }else{
        echo "Veuillez rentrer votre email";
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
            <input type="text" name="email">
            <br/>
            <input type="submit" name="valider">
        </form>
        </section>
        
    </body>
</html>



