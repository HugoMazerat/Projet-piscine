<!Doctype html>
<html>
    <head>
        <title>Page Test</title>
    </head>
    <body>

    <?php
        include 'database.php';
        global $db;
        
        $q = $db->query("SELECT * FROM utilisateur");
        while ($users = $q->fetch()){
            var_dump($utilisateur);
        }

        //$q = $db->prepare("INSERT INTO utilisateur(Nom, Email, Poste) VALUES(:Nom, :Email, :Poste)");
        //$q->execute([
           // 'Nom' => 'Souquieres',
           // 'Email' => 'gabriel.souquieres@edu.ece.fr',
           // 'poste' => 'KING'
       // ]);
    ?>
    </body>
</html>