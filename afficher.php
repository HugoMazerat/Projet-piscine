<?php
   echo '<meta charset="utf-8">';
   //identifier votre BDD
   $database = "linkedln";
   //identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
   $db_handle = mysqli_connect('localhost', 'root', '');
   $db_found = mysqli_select_db($db_handle, $database);

    //Si la BDD existe
if ($db_found) {
    //code MySQL. $sql est basé sur le choix de l’utilisateur
   
    $sql = "SELECT Nom FROM personne";
   
    $sql = "SELECT Prenom FROM personne";
    
    $sql = "SELECT Role FROM personne";
   
    $sql = "SELECT photo FROM personne";

    $sql = "SELECT bio FROM personne";

echo "<h1>Votre ami</h1>";
echo "Résultat:</p>";
$result = mysqli_query($db_handle, $sql);
echo "<table border=\"1\">";
echo "<tr>";
echo "<th>" . "Nom" . "</th>";
echo "<th>" . "Prénom" . "</th>";
echo "<th>" . "role" . "</th>";
echo "<th>" . "bio" . "</th>";
echo "<th>" . "Photo" . "</th>";
echo "</tr>";
while ($data = mysqli_fetch_assoc($result)) 
{
echo "<tr>";
echo "<td>" . $data['Nom'] . "</td>";
echo "<td>" . $data['Prenom'] . "</td>";
echo "<td>" . $data['role'] . "</td>";
echo "<td>" . $data['bio'] . "</td>";
$image = $data['Photo'];
echo "<td>" . "<img src='$image' height='60' width='80'>" . "</td>";
echo "</tr>";
echo "</table>";
 }
}

else {
    echo "<br>Database not found";
}
//fermer la connexion
mysqli_close($db_handle);
?>