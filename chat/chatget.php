<?php
$pdo = new PDO("mysql:host=localhost;dbname=chat","root","");

$json = [];
$sql = "SELECT * FROM chat ORDER BY id DESC";
$pdostatement = $pdo->query($sql);
$pdostatement->execute();
while($resultat = $pdostatement->fetchAll(PDO::FETCH_ASSOC)){
    $json[] = $resultat;
}
echo json_encode($json);