<?php
require "./functions.php";

// Obtener datos del CSV
$path = "./";
$name = "score.csv";
$limit = 100;
$csv_data = readCSV($path, $name, $limit);

// Desencriptar las puntuaciones
$array_score = array();
for ($i = 0; $i < count($csv_data); $i++) {
    $array_score[$csv_data[$i]['jugador']] = decryptedScore($csv_data[$i]['codificacion'], $csv_data[$i]['puntuacion']);
}
// Ordenar el array de puntuaciones
arsort($array_score);

#// Transformacion de los datos a JSON para que sea mas sencillo su uso si van a un front
$json_score = json_encode($array_score);
echo ($json_score);



?>