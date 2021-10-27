<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8</title>
</head>
<style>
    h1#titulo{
        text-align: center;
    }
    table, tr, td, th{
        border: 1px solid black;
        text-align: center;
    }
    td{
        width: 150px;;
    }
    h2{
        margin-left: 120px;
    }
</style>
<body>
    <h1 id="titulo">Ejercicio 8 - PDO</h1>
<?php
$servidor = "localhost";
$baseDatos = "agenciaviajes";
$usuario = "developer";
$pass = "developer";
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos",$usuario,$pass);
    echo "<h3Se ha conectado correctamente<h3>";
    $sql = "SELECT * FROM turista";
    

    // PDO::FETCH_ASSOC
    $turistas = $conexion -> query($sql);
    echo "<h2>PDO::FETCH_ASSOC</h2>";
    echo '<table><tr><th>Nombre</th><th>Primer Apellido</th><th>Dirección</th></tr>';
    while($turista = $turistas->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        echo "<td>".$turista['nombre']."</td>";
        echo "<td>".$turista['apellido1']."</td>";
        echo "<td>".$turista['direccion']."</td>";
        echo '</tr>';
    }
    echo "</table>";

    // PDO::FETCH_NUM
    $turistas = $conexion -> query($sql);
    echo "<h2>PDO::FETCH_NUM</h2>";
    echo '<table><tr><th>Nombre</th><th>Primer Apellido</th><th>Dirección</th></tr>';
    while($turista = $turistas->fetch(PDO::FETCH_NUM)){
        echo '<tr>';
        echo "<td>".$turista[1]."</td>";
        echo "<td>".$turista[2]."</td>";
        echo "<td>".$turista[4]."</td>";
        echo '</tr>';
    }
    echo "</table>";

    // PDO::FETCH_BOTH
    $turistas = $conexion -> query($sql);
    echo "<h2>PDO::FETCH_BOTH</h2>";
    echo '<table><tr><th>Nombre</th><th>Primer Apellido</th><th>Dirección</th></tr>';
    while($turista = $turistas->fetch(PDO::FETCH_BOTH)){
        echo '<tr>';
        echo "<td>".$turista[1]."</td>";
        echo "<td>".$turista['apellido1']."</td>";
        echo "<td>".$turista[4]."</td>";
        echo '</tr>';
    }
    echo "</table>";

    // PDO::FETCH_OBJ
    $turistas = $conexion -> query($sql);
    echo "<h2>PDO::FETCH_OBJ</h2>";
    echo '<table><tr><th>Nombre</th><th>Primer Apellido</th><th>Dirección</th></tr>';
    while($turista = $turistas->fetch(PDO::FETCH_OBJ)){
        echo '<tr>';
        echo "<td>".$turista->nombre."</td>";
        echo "<td>".$turista->apellido1."</td>";
        echo "<td>".$turista->direccion."</td>";
        echo '</tr>';
    }
    echo "</table>";

    // PDO::FETCH_LAZY
    $turistas = $conexion -> query($sql);
    echo "<h2>PDO::FETCH_LAZY</h2>";
    echo '<table><tr><th>Nombre</th><th>Primer Apellido</th><th>Dirección</th></tr>';
    while($turista = $turistas->fetch(PDO::FETCH_LAZY)){
        echo '<tr>';
        echo "<td>".$turista->nombre."</td>";
        echo "<td>".$turista['apellido1']."</td>";
        echo "<td>".$turista[4]."</td>";
        echo '</tr>';
    }
    echo "</table>";

    // PDO::FETCH_BOUND
    $turistas = $conexion -> query($sql);
    echo "<h2>PDO::FETCH_BOUND</h2>";
    $turistas->bindColumn('nombre',$nombre); // Nombre
    $turistas->bindColumn('apellido1',$apellido1); // Primer apellido
    $turistas->bindColumn('direccion',$direccion); // Direccion
    echo '<table><tr><th>Nombre</th><th>Primer Apellido</th><th>Dirección</th></tr>';
    while($turista = $turistas->fetch(PDO::FETCH_BOUND)){
        echo '<tr>';
        echo "<td>".$nombre."</td>";
        echo "<td>".$apellido1."</td>";
        echo "<td>".$direccion."</td>";
        echo '</tr>';
    }
    echo "</table>";


} catch (PDOException $e) {
    echo "Ha fallado la conexión: " . $e->getMessage();
}
?>
</body>
</html>