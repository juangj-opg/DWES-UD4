<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
</head>
<style>
    h1#titulo{
        text-align: center;
    }
    table{
        text-align: center;
        width: 100%;
        background-color: rgba(60,60,60,0.5);
        
    }
    table, tr, td, th{
        border: 1px solid black;
        border-radius: 5px;
    }
    td:hover{
        background-color: rgba(120,120,120,0.5)
    }

    tr#r1{
        background-color: #FFCCCC;
    }

    tr#r1:hover{
        background-color: rgba(255,150,150,0.9);
    }

    tr#r2{
        background-color: #CCCCFF;
    }

    tr#r2:hover{
        background-color: rgba(150,150,255,0.9);
    }
</style>
<body>
<h1 id="titulo">Ejercicio 5</h1>
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
    if($result==false){
        echo 'Fallo en la consulta';
    } else{
        $contador = 0;
        echo '<h3>Mostramos la tabla de como está en el inicio</h3>';
        echo '<table>';
        echo '<tr bgcolor="#CCFFCC">';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_assoc($result)){
            if($contador==0){
                echo '<tr id="r1">';
                $contador++;
            } else{
                echo '<tr id="r2">';
                $contador--;
            }
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
    
    echo "<h3>Añadimos una nueva fila</h3>";
    echo "<p>Esta nueva fila agregará un viaje de Málaga a Madrid</p>";
    $result = mysqli_query($mysqli,"INSERT INTO `vuelos` (Origen, Destino, Fecha, Companya, ModeloAvion) VALUES ('Málaga', 'Madrid', '2021-10-25 11:46:52', 'Iberia', 'A320')");;
    if($result==false){
        echo "La consulta no ha funcionado correctamente";
    } else{
        echo "Se han añadido ",mysqli_affected_rows($mysqli)," filas, cuya id es: ",mysqli_insert_id($mysqli),".<br>";
    }
    $result = mysqli_query($mysqli,"SELECT * FROM vuelos WHERE Origen='Málaga'");    
    if($result==false){
        echo 'Fallo en la consulta';
    } else{
        $contador = 0;
        echo '<h3>Mostramos la tabla buscando el Origen Málaga</h3>';
        echo '<table>';
        echo '<tr bgcolor="#CCFFCC">';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_assoc($result)){
            if($contador==0){
                echo '<tr id="r1">';
                $contador++;
            } else{
                echo '<tr id="r2">';
                $contador--;
            }
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

    echo "<h3>Actualizamos la fila</h3>";
    echo "<p>Ahora actualizaremos la fila de Origen Málaga para que cambie a Cádiz </p>";

    $result = mysqli_query($mysqli,"UPDATE vuelos SET ORIGEN='Cádiz' WHERE Origen='Málaga'");
    if($result==false){
        echo "La consulta no ha funcionado correctamente";
    } else{
        echo "Se han actualizado ",mysqli_affected_rows($mysqli)," filas.<br>";
    }
    $result = mysqli_query($mysqli,"SELECT * FROM vuelos WHERE Origen='Cádiz'");    
    if($result==false){
        echo 'Fallo en la consulta';
    } else{
        $contador = 0;
        echo '<h3>Mostramos la tabla buscando el Origen Málaga</h3>';
        echo '<table>';
        echo '<tr bgcolor="#CCFFCC">';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_assoc($result)){
            if($contador==0){
                echo '<tr id="r1">';
                $contador++;
            } else{
                echo '<tr id="r2">';
                $contador--;
            }
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


    echo "<h3>Borramos una de las filas</h3>";
    echo "<p>Ahora borraremos todas los vuelos de origen Cádiz</p>";
    
    $result = mysqli_query($mysqli,"DELETE FROM `vuelos` WHERE Origen='Cádiz'");
    if($result==false){
        echo "La consulta no ha funcionado correctamente";
    } else{
        echo "Se han borrado ",mysqli_affected_rows($mysqli)," filas.";
    }

     

    $result2 = mysqli_query($mysqli,"SELECT * FROM vuelos");
    if($result2==false){
        echo 'Fallo en la consulta';
    } else{
        $contador = 0;
        echo '<h3>Comprobamos que se ha borrado todos los viajes de Origen Cádiz</h3>';
        echo '<table>';
        echo '<tr bgcolor="#CCFFCC">';
        echo '<th>ID</th>';
        echo '<th>Origen</th>';
        echo '<th>Destino</th>';
        echo '<th>Fecha</th>';
        echo '<th>Compañia</th>';
        echo '<th>Modelo Avion</th>';
        echo '</tr>';
        while($fila=mysqli_fetch_assoc($result2)){
            if($contador==0){
                echo '<tr id="r1">';
                $contador++;
            } else{
                echo '<tr id="r2">';
                $contador--;
            }
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


    mysqli_close($mysqli);
}
?>
</body>
</html>