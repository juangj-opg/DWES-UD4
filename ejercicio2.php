<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<style>
    table, td, tr{
        border: 1px solid black;
    }
</style>
<body>

    <h2>Ejercicio 2 - CSV</h2>
<?php
    // Abrir el fichero en modo lectura
    $file = fopen("./locations.csv", "r");
    echo "<table>";
    while(!feof($file)) {
        $linea = fgets($file);
        $Arr = str_getcsv($linea);
        echo "<tr>";
        foreach ($Arr as $V) {
            if(str_starts_with($V," ")){
                echo ", $V</td>";
            } else{
                echo "<td>$V";
            }
            
        }
        echo "</tr>";
      }
    echo "</table>";
    fclose($file);

    // Abrir el fichero en modo escritura y añadimos un nuevo nombre
    $file = fopen("./locations.csv", "a");
    fwrite($file, PHP_EOL.'Giralda,"37.3862,-5.9926"');
    fclose($file);
?>
</body>
</html>