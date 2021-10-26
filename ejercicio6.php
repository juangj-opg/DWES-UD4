<?php
// Fichero de funciones, será redirigido automáticamente a pruebasEjercicio6.php

function CreaConexion(){
    @$mysqli = mysqli_connect('localhost','developer','developer','agenciaviajes');
    $error = mysqli_connect_errno();
    if ($error!= null) {
        echo "<p>Error $error conectando a la base de datos:".mysqli_connect_error()."</p>";
        exit();
    } 
    return $mysqli;
}

function creaVuelo($origen, $destino, $fecha, $companya, $modeloAvion){
    $mysqli = CreaConexion();
    $sql="INSERT INTO vuelos (Origen, Destino, Fecha, Companya, ModeloAvion) VALUES  (?, ?, ?, ?, ?)";
    $consulta=mysqli_stmt_init($mysqli);
    if ($stmt = mysqli_prepare($mysqli,$sql)){
        mysqli_stmt_bind_param($stmt, "sssss", $origen, $destino, $fecha, $companya, $modeloAvion);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($mysqli);
        echo "<script> console.log('Se ha añadido correctamente el viaje de $origen a $destino.') </script>";
        return true;
    } else{
        echo "<script> console.log('No se ha podido añadir el viaje de $origen a $destino.') </script>";
        mysqli_close($mysqli);
        return false;
    }
    
}

function modificaDestino($id, $destino){
    $mysqli = CreaConexion();
    $sql="UPDATE vuelos SET Destino=? WHERE id=?";
    $consulta=mysqli_stmt_init($mysqli);
    if ($stmt = mysqli_prepare($mysqli,$sql)){
        mysqli_stmt_bind_param($stmt, "si", $destino, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($mysqli);
        echo "<script> console.log('Se ha actualizado correctamente el destino del ID $id a $destino.') </script>";
        return true;
    } else {
        echo "<script> console.log('No se ha podido actualizar el destino del ID $id a $destino.') </script>";
        mysqli_close($mysqli);
        return false;
    }
    
}
function modificaCompanya($id,$companya){
    $mysqli = CreaConexion();
    $sql="UPDATE vuelos SET Companya=? WHERE id=?";
    $consulta=mysqli_stmt_init($mysqli);
    if ($stmt = mysqli_prepare($mysqli,$sql)){
        mysqli_stmt_bind_param($stmt, "si", $companya, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($mysqli);
        echo "<script> console.log('Se ha actualizado correctamente el destino del ID $id a $companya.') </script>";
        return true;
    } else {
        echo "<script> console.log('No se ha podido actualizar la compañia del ID $id a $companya.') </script>";
        mysqli_close($mysqli);
        return false;
    }
    
}

function eliminaVuelo($id){
    $mysqli = CreaConexion();
    $sql="DELETE FROM vuelos WHERE id=?";
    $consulta=mysqli_stmt_init($mysqli);
    if ($stmt = mysqli_prepare($mysqli,$sql)){
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($mysqli);
        echo "<script> console.log('Se ha borrado el viaje con ID $id correctamente.') </script>";
        return true;
    } else{
        return false;
    }
    
}

function extraeVuelos(){
    $mysqli = CreaConexion();
    $result2 = mysqli_query($mysqli,"SELECT * FROM vuelos");
    if($result2==false){
        echo 'Fallo en la consulta';
    } else{
        $contador = 0;
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
    
}
?>