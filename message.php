<?php
session_start();
// Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=pj1;charset=utf8', 'root', '');
if(!$_SESSION['email']){
    header('Location: connexion.php');
}

if(isset($_GET['ID']) AND !empty($_GET['ID'])){

    $getid = $_GET['ID'];
    $recupUser = $bdd->prepare('SELECT * FROM utilisateurs WHERE ID = ?');
    $recupUser->execute(array($getid));
    if($recupUser->rowCount() > 0){
        if(isset($_POST['envoyer']))
        {
            $message = htmlspecialchars($_POST['message']);
            $id_auteur = isset($_SESSION['ID']) ? $_SESSION['ID'] : null; // Vérification de $_SESSION['ID']
            $insererMessage = $bdd->prepare('INSERT INTO message(message, id_destinataire, id_auteur)VALUES(?, ?, ?)');
            $insererMessage->execute(array($message, $getid, $_SESSION['ID']));
        }

    }else{
        echo " Aucun utilisateur trouvé";
    }


}else{
    echo " Aucun identifiant trouvé";
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Message Privé</title>
        <meta charset="utf-8">
    </head>

    <body>
        <form method="POST" action="">
            <textarea name="message"></textarea>
            <br/><br/>
            <input type="submit" name="envoyer">
        </form>

        <section id="messages">
            <?php 
                $recupMessages = $bdd->prepare('SELECT * FROM message WHERE id_auteur = ? AND id_destinataire = ? OR id_auteur = ? AND id_destinataire = ?');
                $recupMessages->execute(array($_SESSION['ID'], $getid, $getid, $_SESSION['ID']));
                while($message = $recupMessages->fetch()){
                    if($message['id_destinataire'] == $_SESSION['ID'] ){
                        ?>
                        <p style="color:red"><?= $message['message']; ?></p>
                        <?php
                    }elseif($message['id_destinataire']== $getid){
                        ?>
                        <p style="color:green"><?= $message['message']; ?></p>
                        <?php
                    }

                }
            ?>

        </section>

    </body>
</html>