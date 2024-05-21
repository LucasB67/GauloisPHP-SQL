<style>
th, td {
    padding: 2px;
    text-align: center;
    border : 1px solid black;
}
tr:nth-child(odd){background: #f1f2af;}
tr:nth-child(even){background:#abe0ee;}
</style>


<?php

// On se connecte à la base.
try {
    $mysqlClient = new PDO('mysql:host=localhost;dbname=gaulois;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// On crée et execute la commande SQL, on passe le résultat dans une variable.
$sqlQuery = 'SELECT * 
                FROM personnage
                JOIN lieu USING(id_lieu)
                JOIN specialite USING(id_specialite)';

$personnagesStatement = $mysqlClient->prepare($sqlQuery);
$personnagesStatement->execute();
$personnages = $personnagesStatement->fetchAll();

// On crée la première ligne du tableau
echo "<table style='border: 3px solid black;'>
        <tr>
            <th>Nom</th>
            <th>Spécialité</th>  
            <th>Lieu d'habitation</th>
        </tr>";

// Boucle pour récupérer les valeurs de chaque personnage.
foreach ($personnages as $personnage) {

    echo "<tr>
    <td><b>".$personnage['nom_personnage']."</b></td>
    <td>".$personnage['nom_specialite']."</td>
    <td>".$personnage['nom_lieu']."</td></tr>";
    }

echo "</table>"

?>
