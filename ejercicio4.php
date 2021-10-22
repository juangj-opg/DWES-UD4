<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<style>
    table{
        text-align: center;
        width: 100%;
    }
    table, tr, td, th{
        border: 1px solid black;
    }
</style>
<body>
<h1>Ejercicio 4 - PHP + MySQL</h1>
<?php
@$mysqli = mysqli_connect('localhost','developer','developer','agenciaviajes');
$error = mysqli_connect_errno();
if ($error!= null) {
    echo "<p>Error $error conectando a la base de datos:".mysqli_connect_error()."</p>";
    exit();
} else{
    echo "<h2>Conectado correctamente</h2>";
    // Cada result, es se consulta de una forma diferente
    $result = mysqli_query($mysqli,"SELECT * FROM vuelos");
    $result2 = mysqli_query($mysqli,"SELECT * FROM vuelos");
    $result3 = mysqli_query($mysqli,"SELECT * FROM vuelos");
    $result4 = mysqli_query($mysqli,"SELECT * FROM vuelos");
    
    if($result==false){
        echo 'Fallo en la consulta';
    } else{
        echo '<h3>Forma 1 - mysqli_fetch_assoc()</h3>';
        echo '<table> <tr>';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_assoc($result)){
            echo '<tr>';
            echo '<td>'.$fila['id'].'</td>';
            echo '<td>'.$fila['Origen'].'</td>';
            echo '<td>'.$fila['Destino'].'</td>';
            echo '<td>'.$fila['Fecha'].'</td>';
            echo '<td>'.$fila['Companya'].'</td>';
            echo '<td>'.$fila['ModeloAvion'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    if($result2==false){
        echo 'Fallo en la consulta';
    } else{
        echo '<h3>Forma 2 - mysqli_fetch_object()</h3>';
        echo '<table> <tr>';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_object($result2)){
            echo '<tr>';
            echo '<td>'.$fila->id.'</td>';
            echo '<td>'.$fila->Origen.'</td>';
            echo '<td>'.$fila->Destino.'</td>';
            echo '<td>'.$fila->Fecha.'</td>';
            echo '<td>'.$fila->Companya.'</td>';
            echo '<td>'.$fila->ModeloAvion.'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    if($result3==false){
        echo 'Fallo en la consulta';
    } else{
        echo '<h3>Forma 3 - mysqli_fetch_array()</h3>';
        echo '<table> <tr>';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_array($result3)){
            echo '<tr>';
            echo '<td>'.$fila['id'].'</td>';
            echo '<td>'.$fila['Origen'].'</td>';
            echo '<td>'.$fila['Destino'].'</td>';
            echo '<td>'.$fila['Fecha'].'</td>';
            echo '<td>'.$fila['Companya'].'</td>';
            echo '<td>'.$fila['ModeloAvion'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    if($result4==false){
        echo 'Fallo en la consulta';
    } else{
        echo '<h3>Forma 4 - mysqli_fetch_row()</h3>';
        echo '<table> <tr>';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_row($result4)){
            echo '<tr>';
            echo '<td>'.$fila[0].'</td>';
            echo '<td>'.$fila[1].'</td>';
            echo '<td>'.$fila[2].'</td>';
            echo '<td>'.$fila[3].'</td>';
            echo '<td>'.$fila[4].'</td>';
            echo '<td>'.$fila[5].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    mysqli_close($mysqli);
}
?>
</body>
</html>