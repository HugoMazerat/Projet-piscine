<?php

$conn = mysqli_connect("localhost", "root", "Gabi2002!", "test");

$utilisateur_id = $_POST['utilisateur_id'];
$ami_id = $_POST['ami_id'];

$sql = "INSERT INTO amis (utilisateur_id, ami_id) VALUES ('$utilisateur_id', 'ami_id')";
mysqli_query($conn, $sql);

//header("Location: profil.php");
?>
