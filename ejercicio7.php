<?php

function CreaConexion(){
    @$mysqli = new mysqli('localhost','developer','developer','agenciaviajes');
    $error = $mysqli -> connect_errno;
    if ($error!= null) {
        echo "<p>Error $error conectando a la base de datos:".$mysqli -> connect_error."</p>";
        exit();
    } 
    return $mysqli;
}

function creaVuelo($origen, $destino, $fecha, $companya, $modeloAvion){
    $mysqli = CreaConexion();
    $sql="INSERT INTO vuelos (Origen, Destino, Fecha, Companya, ModeloAvion) VALUES  (?, ?, ?, ?, ?)";
    $consulta= $mysqli -> stmt_init();
    if ($stmt = $mysqli -> prepare($sql)){
        $stmt -> bind_param("sssss", $origen, $destino, $fecha, $companya, $modeloAvion);
        $stmt -> execute();
        $stmt -> close();
        $mysqli -> close();
        echo "<script> console.log('Se ha añadido correctamente el viaje de $origen a $destino.') </script>";
        return true;
    } else{
        echo "<script> console.log('No se ha podido añadir el viaje de $origen a $destino.') </script>";
        $mysqli -> close();
        return false;
    }   
}

function modificaDestino($id, $destino){
    $mysqli = CreaConexion();
    $sql="UPDATE vuelos SET Destino=? WHERE id=?";
    $consulta= $mysqli -> stmt_init();
    if ($stmt = $mysqli -> prepare($sql)){
        $stmt -> bind_param("si", $destino, $id);
        $stmt -> execute();
        $stmt -> close();
        $mysqli -> close();
        echo "<script> console.log('Se ha actualizado correctamente el destino del ID $id a $destino.') </script>";
        return true;
    } else {
        echo "<script> console.log('No se ha podido actualizar el destino del ID $id a $destino.') </script>";
        $mysqli -> close();
        return false;
    }   
}

function modificaCompanya($id, $companya){
    $mysqli = CreaConexion();
    $sql="UPDATE vuelos SET Companya=? WHERE id=?";
    $consulta= $mysqli -> stmt_init();
    if ($stmt = $mysqli -> prepare($sql)){
        $stmt -> bind_param("si", $companya, $id);
        $stmt -> execute();
        $stmt -> close();
        $mysqli -> close();
        echo "<script> console.log('Se ha actualizado correctamente la compañia del ID $id a $companya.') </script>";
        return true;
    } else {
        echo "<script> console.log('No se ha podido actualizar la compañia del ID $id a $companya.') </script>";
        $mysqli -> close();
        return false;
    }   
}

function eliminaVuelo($id){
    $mysqli = CreaConexion();
    $sql="DELETE FROM vuelos WHERE id=?";
    $consulta= $mysqli -> stmt_init();
    if ($stmt = $mysqli -> prepare($sql)){
        $stmt -> bind_param("i", $id);
        $stmt -> execute();
        $stmt -> close();
        $mysqli -> close();
        echo "<script> console.log('Se ha borrado el viaje con ID $id correctamente.') </script>";
        return true;
    } else{
        $mysqli -> close();
        echo "<script> console.log('No se ha podido borrar el viaje con ID $id correctamente.') </script>";
        return false;
    }
    
}

function extraeVuelo(){
    $mysqli = CreaConexion();
    $sql="SELECT * FROM vuelos";
    $result = $mysqli -> query($sql);
    return $result;
}

//creaVuelo("Irún","Valencia","2021-11-23 16:20:18","Iberia","A320");
modificaDestino(18, "Narnia");
modificaCompanya(18, "Armario");
eliminaVuelo(10);

$Vuelos = extraeVuelo();
while($fila=mysqli_fetch_assoc($Vuelos)){
    print_r($fila);
    echo "<br>";
}
?>