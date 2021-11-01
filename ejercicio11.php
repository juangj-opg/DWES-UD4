<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11</title>
</head>
<!-- Estilos usados para el Ejercicio 9 -->
<link rel="stylesheet" href="Ej11-style.css">
<body>
<div id="barragris">
    <div id="izq">
        <a href="./ejercicio10.php"><b>< < Ejercicio 10</b></a>
    </div>
</div>
<div id="cabecerapadre">
 <div id="cabecerahijo">
    <h1 id="titulo">Ejercicio 11</h1>
    <h2 id="titulo">PDO<br>Crear funciones para Insertar, Mostrar, Actualizar y Borrar</h2>
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
    // ExtraeTuristas
    // ----------------------------------------------------------------------------------------------
    
    echo "<h2>Función extraeTuristas </h2>";
    echo "<p>Está función devolverá un array con todas las filas de los turistas.</p>";
    echo "<p>Con ese array, lo transformaremos en una tabla usando otra función.</p>";

    $Turistas = extraeTuristas($conexion);
    MuestraTablaTuristas($Turistas);

    // ----------------------------------------------------------------------------------------------
    // ExtraeTurista
    // ----------------------------------------------------------------------------------------------
    
    echo "<h2>Función extraeTurista </h2>";
    echo "<p>Está función devolverá una única array del turista señalado.</p>";
    echo "<p>Se le dará una ID a la función para así devolver la fi0la del turista.</p>";
    

    print_r(extraeTurista($conexion,1));
    $turista = extraeTurista($conexion,1);
    echo '<br><br>';
    MuestraTablaTurista($turista);


    // ----------------------------------------------------------------------------------------------
    // CreaTursita
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Funcion creaTurista</h2>";
    echo "<p>Esta función insertará un turista y nos retornará una id, que sería la ID ";
    $id = creaTurista($conexion, 'Guillermo', 'Garrido', 'Jiménez', 'Sevilla', '643343434');
    echo "$id.</p>";

    print_r(extraeTurista($conexion,$id));
    $turista = extraeTurista($conexion, $id);
    echo '<br><br><table><tr bgcolor="#CCFFCC"><th>ID</th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Dirección</th><th>Teléfono</th></tr>';
    echo "<tr id='r1'><td>$turista[id]</td><td>$turista[nombre]</td><td>$turista[apellido1]</td><td>$turista[apellido2]</td><td>$turista[direccion]</td><td>$turista[telefono]</td></tr>";
    echo '</table>';

    // ----------------------------------------------------------------------------------------------
    // ActualizaTurista
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Función ActualizaTurista</h2>";
    echo "<p>Se actualizará el telefono y la dirección de uno de los turistas usando la ID.</p>";

    $Valor = actualizaTurista($conexion, 'Sevilla', '643343434', '7');
    if ($Valor) { // True
        echo "<h3>Comprobamos que se ha actualizado correctamente (o intentado) mostrando la tabla.</h3>";
        $turista = extraeTurista($conexion, 7);
        MuestraTablaTurista($turista);
    } else {
        echo "No se ha podido actualizar el turista.";
    }
    

    // ----------------------------------------------------------------------------------------------
    // EliminaTurista
    // ----------------------------------------------------------------------------------------------
    echo "<h2>Función eliminaTurista</h2>";
    echo "<p>Se borrará un turista gracias a una función creada llamada eliminaTurista.<br>.En esta función solo tendremos que darle una ID a la función para que esta se encargue de borrarla.<br>En este caso, se ha intentado borrar la fila con el ID 4.</p>";

    eliminaTurista($conexion, '4');
    echo "<h3>Comprobamos que se ha borrado correctamente (o intentado) mostrando la tabla.</h3>";
    $Turistas = extraeTuristas($conexion);
    MuestraTablaTuristas($Turistas);

    // ----------------------------------------------------------------------------------------------
    // Fin del Ejercicio
    // ----------------------------------------------------------------------------------------------

} catch (PDOException $e) {
    echo "Ha fallado la conexión con el siguiente mensaje de error: " . $e->getMessage();
}

// Función extreaTuristas
function extraeTuristas($c){
    $sql = "SELECT * FROM turista";
    $turistas = $c->prepare($sql);
    $turistas->execute();
    $ArrTurista = $turistas->fetchAll(\PDO::FETCH_ASSOC);
    $ArrTurista;
    return $ArrTurista;
}

// Función para mostrar la tabla, el array se lo dará extraeTuristas()
// Esta función el ejercicio NO lo pide.
function MuestraTablaTuristas($ArrTuristas){
    $contador = 0;
    echo '<table><tr bgcolor="#CCFFCC"><th>ID</th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Dirección</th><th>Teléfono</th></tr>';
    foreach ($ArrTuristas as $turista) {
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

// Función extraeTurista
// Retornará un array del turista elegido según la id. 
function extraeTurista($c, $id){
    $sql = "SELECT * FROM turista WHERE id=?"; 
    $consulta = $c->prepare($sql);
    $consulta -> bindParam(1, $id);
    $consulta -> execute();
    while($fila = $consulta->fetch(PDO::FETCH_ASSOC)){
        return $fila;
    }
}

// Función para mostrar la tabla con una única fila, el array se lo dará extraeTurista()
// Esta función el ejercicio NO lo pide.
function MuestraTablaTurista($ArrTurista){
    echo '<table><tr bgcolor="#CCFFCC"><th>ID</th><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Dirección</th><th>Teléfono</th></tr>';
        echo "<tr id='r1'>";
        echo "<td>".$ArrTurista['id']."</td>";
        echo "<td>".$ArrTurista['nombre']."</td>";
        echo "<td>".$ArrTurista['apellido1']."</td>";
        echo "<td>".$ArrTurista['apellido2']."</td>";
        echo "<td>".$ArrTurista['direccion']."</td>";
        echo "<td>".$ArrTurista['telefono']."</td>";
        echo "</tr>";
    echo "</table>";
}

// Función creaTurista
// - Retonará el último ID añadido
function creaTurista($c, $n, $a1, $a2, $d, $t){
    $sql = "INSERT INTO turista (nombre, apellido1, apellido2, direccion, telefono) VALUES (?, ?, ?, ?, ?)";
    $consulta = $c->prepare($sql);
    $consulta -> bindParam(1, $n);
    $consulta -> bindParam(2, $a1);
    $consulta -> bindParam(3, $a2);
    $consulta -> bindParam(4, $d);
    $consulta -> bindParam(5, $t);
    $consulta -> execute();
    $last_id= $c -> lastInsertId();
    return $last_id; 
}

// Función actualizaTurista
// - Tiene que retornar true si se ha hecho
// - En caso de fallo, retornará false
function actualizaTurista($c, $d, $t, $id){
    try {
        $sql = "UPDATE turista SET direccion=?,telefono=? WHERE id=?";
        $consulta = $c->prepare($sql);
        $consulta -> bindParam(1, $d);
        $consulta -> bindParam(2, $t);
        $consulta -> bindParam(3, $id);
        $consulta -> execute();
        ConsoleLog("Se ha actualizado el turista con id $id");
        return true;
    } catch (Exception $e) {
        ConsoleLog("No se ha podido actualizar el turista con id $id");
        return false;
    }
    
}

// Función eliminaTurista
// - No retorna nada
function eliminaTurista($c, $id){

    $sql = "DELETE FROM turista WHERE id=?";
    $consulta = $c->prepare($sql);
    $consulta -> bindParam(1, $id);
    $consulta -> execute();
    ConsoleLog("Se ha borrado (o intentado) el turista con ID $id.");
}

function ConsoleLog($mensaje){
    echo "<script> console.log('$mensaje'); </script>";
}
?>



</div>
</body>
</html>