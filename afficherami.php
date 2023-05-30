<?php

$conn = mysqli_connect("localhost", "root", "Gabi2002!", "test");

$utilisateur_id = $_SESSION['utilisateur_id'];

$sql = "SELECT utilisateur.Nom From ajout_amis Join utilisateur ON ajout_amis.ami_id = utilisateur.id WHERE ajout_amis.utilisateur_id = '$utilisateur_id'";
$resultat = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($resultat)){
    echo $row['Nom'] . "<br>";
}
?>