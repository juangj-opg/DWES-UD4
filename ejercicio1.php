<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<style>
    table{
        width: 100%;
        text-align: center;
    }
    table,tr,td{
        border: 1px solid black;
    }
</style>
<body>
<?php
    // Abrir el fichero en modo lectura
    $file = fopen("./fichero1.txt", "r");
    echo "<table>";
    while(!feof($file)) {
        $linea = fgets($file);
        $Arr = str_getcsv($linea);
        echo "<tr>";
        foreach ($Arr as $V) {
            echo "<td>$V</td>";
        }
        echo "</tr>";
      }
    echo "</table>";
    fclose($file);

    // Abrir el fichero en modo escritura y añadimos un nuevo nombre
    $file = fopen("./fichero1.txt", "a");
    fwrite($file, "\nJuan Garrido,175,87,black,fair,dark brown,2000,male,Earth,Human");
    fclose($file);
?>
</body>
</html>