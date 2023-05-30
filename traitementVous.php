<?php

    //données du formulaire
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
    $photo = isset($_POST["photo"])? $_POST["photo"] : "";
    $datenaissance = isset($_POST["datenaissance"])? $_POST["datenaissance"] : "";
    $mail = isset($_POST["mail"])? $_POST["mail"] : "";
    $tel = isset($_POST["tel"])? $_POST["tel"] : "";
    $bio = isset($_POST["bio"])? $_POST["bio"] : "";
    $experience = isset($_POST["experience"])? $_POST["experience"] : "";
    //identification BDD
    $database = "linkedin"; 

    //Connection dans la BDD
    $db_handle = mysqli_connect('localhost','root','72srmxqo');
    $db_found = mysqli_select_db($db_handle, $database); 



    //$linkedin = isset($_POST["personne"])? $_POST["personne"]: "";
    /*if (empty($linkedin)) {
        $linkedin=0;
    }*/
    
    //$sql = "";
    echo "<p>". "Test" . "</p>";
    //Si la BDD existe
    if (isset($_POST["save"])) {
        echo "<p>"."Test2"."</p>";
        if ($db_found) {
            //code MySQL. $sql est basé sur le choix de l’utilisateur
            $sql = "INSERT INTO personne(Nom, Prenom, Photo, DateNaissance, Email, Tel, Bio, Projets) VALUES('$nom', '$prenom', '$photo', '$datenaissance', '$mail', '$tel', '$bio', '$experience')";
            $result = mysqli_query($db_handle, $sql);
            echo "<p>Add successful.</p>";
            //on affiche les données entrées
            $sql = "SELECT * FROM personne";
            $result = mysqli_query($db_handle, $sql);
            echo "<h2>" . "Les données ajoutées sont:" . "</h2>";
            echo "<table>";
            echo "<tr>";
            echo "<th>" . "Votre nom" . "</th>";
            echo "<th>" . "Votre prénom" . "</th>";
            echo "<th>" . "Votre photo" . "</th>";
            echo "<th>" . "Votre date de naissance" . "</th>";
            echo "<th>" . "Votre e-mail" . "</th>";
            echo "<th>" . "Votre numéro de téléphone" . "</th>";
            echo "<th>" . "Votre parcours" . "</th>";
            echo "<th>" . "Votre expérience la plus pertinente" . "</th>";
            //afficher le resultat
            while ($data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $data['Nom'] . "</td>";
                echo "<td>" . $data['Prenom'] . "</td>";
                $image = $data['Photo'];
                echo "<td>" . "<img src='$image' height='120' width='100'>" . "</td>";
                echo "<td>" . $data['DateNaissance'] . "</td>";
                echo "<td>" . $data['Email'] . "</td>";
                echo "<td>" . $data['Tel'] . "</td>";
                echo "<td>" . $data['Bio'] . "</td>";
                echo "<td>" . $data['Projets'] . "</td>";
                
                echo "</tr>";
            }
            echo "</table>";
                
        } else {
            echo "<p>Database not found.</p>";
        }
    }
?>

