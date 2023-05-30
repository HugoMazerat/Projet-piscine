<?php
$conn = mysqli_connect("localhost", "root", "Gabi2002!", "linkedln"); //co à la base de données

if (mysqli_connect_errno()){ //vérificatio que la base de données existe
    die("pas de connexion avec la base de données" . mysqli_connect_error());
}

$email = $_POST['e-mail'];  //récupération des données
$MDP = $_POST['MDP'];

$query = "SELECT * FROM personne WHERE e-mail='$email' AND MDP='$MDP'"; //on vérifie que le MDP et l'email existe bien
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0){
    echo "Identifiants corrects";
} else {
    echo "Identifiants incorrects";
}

mysqli_close($conn);
?>