<?php
$conn=mysqli_connect("localhost", "root", "Gabi2002!", "linkedln");
if(!$conn){
    die("connection impossible");
}
else {
    $requete=mysqli_query($conn, "SELECT mail FROM personne");
    $requete=mysqli_query($conn, "SELECT MDP FROM personne");
}

while($result=mysqli_fetch_array($requete)){
    echo $result['mail'];
    echo $result['MDP'];
}
?>