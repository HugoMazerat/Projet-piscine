<?php
session_start(); // Ajoutez cette ligne pour démarrer la session

// Vérifiez si l'utilisateur est connecté en vérifiant si la variable de session est définie
if (!isset($_SESSION['ID'])) {
    echo "Utilisateur non connecté";
    // Redirigez l'utilisateur vers la page de connexion ou effectuez toute autre action appropriée
    exit;
}

//données du formulaire
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$photo = isset($_POST["photo"]) ? $_POST["photo"] : "";
$datenaissance = isset($_POST["datenaissance"]) ? $_POST["datenaissance"] : "";
$mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
$bio = isset($_POST["bio"]) ? $_POST["bio"] : "";
$experience = isset($_POST["experience"]) ? $_POST["experience"] : "";
$stages = isset($_POST["stages"]) ? $_POST["stages"] : "";
//identification BDD
$database = "linkedin";

//Connection dans la BDD
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

// Récupérer l'ID de l'utilisateur connecté à partir de la session
$user_id = $_SESSION['ID'];

// Vérifier si l'utilisateur existe dans la base de données
$sql = "SELECT * FROM utilisateurs WHERE ID = $user_id";
$result = mysqli_query($db_handle, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // L'utilisateur existe dans la base de données, donc effectuer une mise à jour des informations

    $update_query = ""; // Requête de mise à jour vide initialement

    // Vérifier si des nouvelles informations ont été saisies
    if (!empty($nom)) {
        $update_query .= "nom = '$nom', ";
    }
    if (!empty($prenom)) {
        $update_query .= "prenom = '$prenom', ";
    }
    if (!empty($photo)) {
        $update_query .= "Photo = '$photo', ";
    }
    if (!empty($datenaissance)) {
        $update_query .= "DateNaissance = '$datenaissance', ";
    }
    if (!empty($mail)) {
        $update_query .= "email = '$mail', ";
    }
    if (!empty($tel)) {
        $update_query .= "Tel = '$tel', ";
    }
    if (!empty($bio)) {
        $update_query .= "Bio = '$bio', ";
    }
    if (!empty($experience)) {
        $update_query .= "Projets = '$experience', ";
    }
    if (!empty($stages)) {
        $update_query .= "stages = '$stages', ";
    }

    // Supprimer la virgule finale de la requête de mise à jour
    $update_query = rtrim($update_query, ", ");

    if (!empty($update_query)) {
        // Si des nouvelles informations ont été saisies, exécuter la requête de mise à jour

        // Code MySQL pour mettre à jour les informations de l'utilisateur
        $sql = "UPDATE utilisateurs SET $update_query WHERE ID = $user_id";
        $result = mysqli_query($db_handle, $sql);

        if ($result) {
            echo "<p>Update successful.</p>";
        } else {
            echo "<p>Failed to update.</p>";
        }
    } else {
        echo "<p>No new information entered.</p>";
    }

    if (isset($_POST["generer"])) {
    // Récupérer les informations de l'utilisateur depuis la base de données
    $user_id = $_SESSION['ID'];
    $sql = "SELECT * FROM utilisateurs WHERE ID = $user_id";
    $result = mysqli_query($db_handle, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        $nom = isset($_POST["nom"]) ? $_POST["nom"] : $data['nom'];
        $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : $data['prenom'];
        $photo = isset($_POST["photo"]) ? $_POST["photo"] : $data['Photo'];
        $datenaissance = isset($_POST["datenaissance"]) ? $_POST["datenaissance"] : $data['DateNaissance'];
        $mail = isset($_POST["mail"]) ? $_POST["mail"] : $data['email'];
        $tel = isset($_POST["tel"]) ? $_POST["tel"] : $data['Tel'];
        $bio = isset($_POST["bio"]) ? $_POST["bio"] : $data['Bio'];
        $experience = isset($_POST["experience"]) ? $_POST["experience"] : $data['Projets'];
        $stages = isset($_POST["stages"]) ? $_POST["stages"] : $data['stages'];
        

        // Ouvrir le fichier en écriture
        $file = fopen("example.html", "w");

        // Écrire le code HTML dans le fichier
        $html = "<html>\n<head>\n<title>CV</title>\n</head>\n<body>\n<p>$nom $prenom</p>\n<img src='$photo' height='120' width='100'>\n<p>$datenaissance</p>\n<p>$mail</p>\n<p>$tel</p>\n<p>$bio</p>\n<p>$experience</p>\n<p>$stages</p>\n</body>\n</html>";
        fwrite($file, $html);

        // Fermer le fichier
        fclose($file);

        echo "<p>CV généré avec succès.</p>";
    } else {
        echo "<p>User not found.</p>";
    }
}

}
    
?>
