<?php
session_start(); // démarrage de la session

// on vérifie si l'utilisateur est connecté
if (!isset($_SESSION['ID'])) 
{
    echo "Utilisateur non connecté";
    exit; // si l'utilisateur n'est pas connecté on le redirige vers la page d'accueil
}

//on récup les données du formulaire avec "$_POST"
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$photo = isset($_POST["photo"]) ? $_POST["photo"] : "";
$datenaissance = isset($_POST["datenaissance"]) ? $_POST["datenaissance"] : "";
$mail = isset($_POST["mail"]) ? $_POST["mail"] : "";
$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
$bio = isset($_POST["bio"]) ? $_POST["bio"] : "";
$experience = isset($_POST["experience"]) ? $_POST["experience"] : "";
$stages = isset($_POST["stages"]) ? $_POST["stages"] : "";
$Formation = isset($_POST["Formation"]) ? $_POST["Formation"] : "";

//Connection à la BDD
$database = "linkedin";
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

// Recup l'ID de l'utilisateur avec la session
$user_id = $_SESSION['ID'];

// On vérif si l'utilisateur connecté existe dans la BDD avec un requete SQL
$sql = "SELECT * FROM utilisateurs WHERE ID = $user_id";
$result = mysqli_query($db_handle, $sql);

if ($result && mysqli_num_rows($result) > 0) // si l'utlisateur existe on met à jour les informations du formulaire 
{ 
    $update_query = ""; // on initialise la requete de mise à jour à nulle

    // si la requete de mise à jour n'est pas nulle -> on met à jour les données
    if (!empty($nom)) 
    {
        $update_query .= "nom = '$nom', ";
    }
    if (!empty($prenom))
    {
        $update_query .= "prenom = '$prenom', ";
    }
    if (!empty($photo)) 
    {
        $update_query .= "Photo = '$photo', ";
    }
    if (!empty($datenaissance)) 
    {
        $update_query .= "DateNaissance = '$datenaissance', ";
    }
    if (!empty($mail)) 
    {
        $update_query .= "email = '$mail', ";
    }
    if (!empty($tel)) 
    {
        $update_query .= "Tel = '$tel', ";
    }
    if (!empty($bio)) 
    {
        $update_query .= "Bio = '$bio', ";
    }
    if (!empty($experience)) 
    {
        $update_query .= "Projets = '$experience', ";
    }
    if (!empty($stages)) 
    {
        $update_query .= "stages = '$stages', ";
    }
    if (!empty($stages)) 
    {
        $update_query .= "Formation = '$Formation', ";
    }

    $update_query = rtrim($update_query, ", "); // on supprime la ";"" finale de la requête de mise à jour

    if (!empty($update_query))  // Si des nouvelles informations ont été saisies, exécuter la requête de mise à jour
    {
        $sql = "UPDATE utilisateurs SET $update_query WHERE ID = $user_id"; // requete MySQL pour mettre à jour les informations de l'utilisateur
        $result = mysqli_query($db_handle, $sql);

        if ($result) 
        {
            echo "<p>Mise à jour des données réussie.</p>";
        } else 
        {
            echo "<p>Erreur de mise à jour des données.</p>";
        }
    } 
    else 
    {
        echo "<p>Pas de nouvelle information rentrée.</p>";
    }

    if (isset($_POST["generer"])) 
    {  // si l'utilisateur clique sur le bouton le CV -> on récpuère les informations dans la BDD 
    
        $user_id = $_SESSION['ID'];
        $sql = "SELECT * FROM utilisateurs WHERE ID = $user_id";
        $result = mysqli_query($db_handle, $sql);
        
        if ($result && mysqli_num_rows($result) > 0) 
        {
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
            $Formation = isset($_POST["Formation"]) ? $_POST["Formation"] : $data['Formation'];
            
            $file = fopen("example.html", "w"); // On ouvre un fichier html en mode écriture
            
            // on écris dans le fichier html
            $html = "<html>\n<head>\n<title>CV</title>\n</head>\n<body>\n<p>$nom $prenom</p>\n<img src='$photo' height='120' width='100'>\n<p>$datenaissance</p>\n<p>$mail</p>\n<p>$tel</p>\n<p>$bio</p>\n<p>$experience</p>\n<p>$stages</p>\n<p>$Formation</p>\n</body>\n</html>";
            fwrite($file, $html);
            fclose($file); // on ferme le fichier
            echo "<p>CV généré avec succès.</p>";
        } 
        else 
        {
            echo "<p>Utilisateur .</p>";
        }
    }
}
