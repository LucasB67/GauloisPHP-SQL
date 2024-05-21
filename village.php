<?php

// On se connecte à la base.
try {
    $mysqlClient = new PDO('mysql:host=localhost;dbname=gaulois;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


$id = 1;
$sqlQuery = "SELECT * 
                FROM lieu 
                WHERE id_lieu = :id";
$villageStatement = $mysqlClient->prepare($sqlQuery);
$villageStatement->execute(["id" => $id]);
$village = $villageStatement->fetch();


$sqlQuery = "SELECT * 
                FROM personnage
                WHERE id_lieu = :id";
$personnagesStatement = $mysqlClient->prepare($sqlQuery);
$personnagesStatement->execute(["id" => $id]);
$personnages = $personnagesStatement->fetchAll();


echo "<h1>".$village['nom_lieu']."</h1><ul>";
foreach ($personnages as $personnage) {
    echo "<li>".$personnage['nom_personnage']."</li>";
    }
echo "</ul>"

?>
