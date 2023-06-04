
?><?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "linkedin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("impossible d'ouvrir la base de données");
}

$sql = "SELECT * FROM offre_emploi";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        echo "<h2>" . $row["Nom"] . "<h2>";
        echo "<p>" . $row["Types"] . "<p>";
        echo "<p>" . $row["Salaire"] . "<p>";
        echo "<p>" . $row["Entreprise"] . "<p>";
        echo "<p>" . $row["Durée"] . "<p>";
        echo "<br>";
    }
}
else{
    echo "Aucune offres disponibles";
}

$conn->close();

?>