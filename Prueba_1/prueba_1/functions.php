<?php

function readCSV($path, $name, $limit, $delimitador = ",")
{
    /*
    Leer CSV en la ruta indicada para que se pueda reutilizar la funcion para otros csv
    
    Input: 
    - Ruta del archivo
    - Nombre del archivo
    - Limite de caracteres a tratar
    - Delimitador de datos, por defecto se usa la coma si no se indica otra cosa
    Output: 
    - Array de datos
    */

    $path_file = $path . $name;
    $fp = fopen($path_file, "r");
    $array_csv = array(array());
    $array_header = array();
    $c = -1;
    while ($data = fgetcsv($fp, $limit, $delimitador)) {
        $num = count($data);

        if ($c >= 0) {
            for ($i = 0; $i < $num; $i++) {
                $array_csv[$c][$array_header[$i]] = $data[$i];
            }
        } else {
            for ($i = 0; $i < $num; $i++) {
                $array_header[$i] = $data[$i];
            }
        }


        $c++;
    }
    fclose($fp);
    return $array_csv;
}

function decryptedScore($system, $score)
{
    /*
    Descifrar puntuacion con el sistema numerico proporcionado
    Pasos:
    1- Averiguar la base (contando el numero de digitos del sistema numerico)
    2- Convertir el sistema numerico a digitos por orden
    3- Usar la formula X = a0*b0^c0 + a1*b1^c1 + ... 
    Donde "a" es la posicion deducida, b es la base deducida y c la potencia correspondiente a la posicion
    4- Devolver la puntuacion descodificada
    
    Input: 
    - Sistema numerico usado para la encriptacion 
    - Puntuacion a descifrar
    Output: 
    - Array de puntuaciones asociado al jugador correspondiente
    */
    $base_deducida = strlen($system);
    $score_len = strlen($score);

    $array_posicion = str_split($system);
    $array_score = str_split($score);
    $posicion_deducida = array();

    for ($i = 0; $i < $score_len; $i++) {
        $pos_score = $array_score[$i];
        for ($j = 0; $j < $base_deducida; $j++) {
            if ($array_posicion[$j] == $pos_score) {
                $posicion_deducida[$i] = $j;
            }
        }
    }
    $score = 0;
    $count = $score_len;
    for ($i = 0; $i < $score_len; $i++) {
        $count -= 1;
        $score += $posicion_deducida[$i] * ($base_deducida ** $count);

    }

    return $score;
}

?>