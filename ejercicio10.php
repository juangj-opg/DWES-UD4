<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
</head>
<!-- Estilos usados para el Ejercicio 10 -->
<link rel="stylesheet" href="Ej10-style.css">
<body>
<div id="barragris">
    <div id="izq">
        <a href="./ejercicio9.php"><b>< < Ejercicio 9</b></a>
    </div>
    <div id="der">
        <a href="./ejercicio11.php"><b>Ejercicio 11 > ></b></a>
    </div>
</div>
<div id="cabecerapadre">
 <div id="cabecerahijo">
    <h1 id="titulo">Ejercicio 10</h1>
    <h2 id="titulo">Transacciones con PDO</h2>
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
    // Para realizar la transición, tenemos que iniciarlo con la siguietne línea:

    $conexion->beginTransaction();

    // ----------------------------------------------------------------------------------------------
    // Mostrar tabla
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Mostrar tabla</h2>";
    echo "<p>Se mostrará la tabla antes de realizar las transacciones con 3 inserts.</p>";

    MuestraTabla($conexion);

    // ----------------------------------------------------------------------------------------------
    // Insertar fila
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Insertar 3 filas</h2>";
    echo "<p>Se insertará tres filas pertenecientes a la misma familia.</p>";

    // Se realiza los 3 querys de insercción de la familia
    
    
    $ID1 = InsertaFila($conexion, 'Juan', 'Garrido', 'Jiménez', 'Sevilla', '634323232');
    $ID2 = InsertaFila($conexion, 'Guillermo', 'Garrido', 'Jiménez', 'Sevilla', '643343434');
    $ID3 = InsertaFila($conexion, 'Guillermo', 'Garrido', 'Pérez', 'Sevilla', '753323534');
    
    // Comprobamos el ID de cada uno si es mayor de 0, en caso que sea menor de 0, no se realizará el commit

    if ($ID1 > 0 && $ID2 > 0 && $ID3 > 0 && $ID1 != $ID2 && $ID1 != $ID3 && $ID2 != $ID3  ) {
        $conexion -> commit();
    } else {
        $conexion -> rollback();
    }
    
    echo "<h3>Mostramos la tabla, si hay un fallo (como que el ID es menor que 0), no se habrá añadido, pero, si está bien, se ejecutará.</h3>";
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
    echo "Se ha añadido correctamente (o intentado) el nuevo turista con el id $last_id.<br>";
    return $last_id; // Se retornará el ID y comprobar si la transacción se puede realizar.
}
?>

</div>
</body>
</html>