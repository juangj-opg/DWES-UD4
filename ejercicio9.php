<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>
<!-- Estilos usados para el Ejercicio 9 -->
<link rel="stylesheet" href="Ej9-style.css">
<body>
<div id="barragris"></div>
<div id="cabecerapadre">
 <div id="cabecerahijo">
    <h1 id="titulo">Ejercicio 9</h1>
    <h2 id="titulo">Insertar, actualizar y borrar con PDO</h2>
 </div>
</div>
<div id="contenedor">

<?php
$servidor = "localhost";
$baseDatos = "agenciaviajes";
$usuario = "developer";
$pass = "developer";
try {
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos",$usuario,$pass);
    echo "<script>console.log('Se ha conectado correctamente a la base de datos.');</script>";

    // ----------------------------------------------------------------------------------------------
    // Mostrar tabla
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Mostrar tabla</h2>";
    echo "<p>Se mostrará la tabla antes de insertar, borrar o actualizar los datos a través de una función creada llamada MuestraTabla.</p>";

    MuestraTabla($conexion);

    // ----------------------------------------------------------------------------------------------
    // Insertar fila
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Insertar fila</h2>";
    echo "<p>Se insertará un turista gracias a una función creada llamada InsertaFila.<br>.Después de insertarlo, mostraremos la tabla para demostrar que se ha insertado correctamente.</p>";

    InsertaFila($conexion, 'Guillermo', 'Garrido', 'Jiménez', 'Sevilla', '643343434');
    echo "<h3>Comprobamos que se ha añadido correctamente mostrando la tabla.</h3>";
    MuestraTabla($conexion);

    // ----------------------------------------------------------------------------------------------
    // Actualizar fila
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Actualizar fila</h2>";
    echo "<p>Se actualizará un turista gracias a una función creada llamada ActualizaFila.<br>.A diferencia del anterior, habrá que proporcionarle una ID para saber cual de todos cambiar.</p>";

    ActualizaFila($conexion, 'Guillermo', 'Garrido', 'Jiménez', 'Sevilla', '643343434', '2');
    echo "<h3>Comprobamos que se ha actualizado correctamente (o intentado) mostrando la tabla.</h3>";
    MuestraTabla($conexion);

    // ----------------------------------------------------------------------------------------------
    // Borrar fila
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Borrar fila</h2>";
    echo "<p>Se borrará un turista gracias a una función creada llamada BorraFila.<br>.En esta función solo tendremos que darle una ID a la función para que esta se encargue de borrarla..</p>";

    BorraFila($conexion, '4');
    echo "<h3>Comprobamos que se ha borrado correctamente (o intentado) mostrando la tabla.</h3>";
    MuestraTabla($conexion);

    // ----------------------------------------------------------------------------------------------
    // Fin del Ejercicio
    // ----------------------------------------------------------------------------------------------

} catch (PDOException $e) {
    echo "Ha fallado la conexión con el siguiente mensaje de error: " . $e->getMessage();
}
// Función para mostrar la tabla
function MuestraTabla($c){
    $sql = "SELECT * FROM turista";
    $contador = 0;
    $turistas = $c -> query($sql);
    echo '<table><tr bgcolor="#CCFFCC"><th>ID</th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Dirección</th><th>Teléfono</th></tr>';
    while($turista = $turistas->fetch(PDO::FETCH_ASSOC)){
        if ($contador == 0) {
            echo '<tr id="r1">';
            $contador++;
        } else{
            echo '<tr id="r2">';
            $contador--;
        }
        
        echo "<td>".$turista['id']."</td>";
        echo "<td>".$turista['nombre']."</td>";
        echo "<td>".$turista['apellido1']."</td>";
        echo "<td>".$turista['apellido2']."</td>";
        echo "<td>".$turista['direccion']."</td>";
        echo "<td>".$turista['telefono']."</td>";
        echo '</tr>';
    }
    echo "</table>";
}

// Función para insertar la fila
function InsertaFila($c, $n, $a1, $a2, $d, $t){
    $sql = "INSERT INTO turista (nombre, apellido1, apellido2, direccion, telefono) VALUES ('$n', '$a1', '$a2', '$d', '$t')";
    $numeroClientes = $c->exec($sql);
    $last_id= $c -> lastInsertId();
    echo "Se ha añadido correctamente el nuevo turista con el id $last_id.";
}

// Función para actualizar la fila
function ActualizaFila($c, $n, $a1, $a2, $d, $t, $id){
    $sql = "UPDATE turista SET nombre='$n',apellido1='$a1',apellido2='$a2',direccion='$d',telefono='$t' WHERE id=$id";
    $numeroClientes = $c->exec($sql);
    echo "Se ha actualizado correctamente (o intentado) el turista con id $id.";
}

// Función para borrar la fila
function BorraFila($c, $id){

    $sql = "DELETE FROM turista WHERE id=$id";
    $numeroClientes = $c->exec($sql);
    echo "Se ha borrado (o intentado) el turista con ID $id.";
}
?>

</div>
</body>
</html>