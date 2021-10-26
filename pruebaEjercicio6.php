<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
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
    <h1 id="titulo">Ejercicio 6</h1>
<?php
include "ejercicio6.php"; 

// creaVuelo()
echo "<h2> Añadir un viaje por la función creaVuelo()</h2>"; 
if (creaVuelo("Irún","Sevilla","2021-10-30 13:00:34","Iberia","A320")){
    echo "<p>Se ha añadido correctamente un nuevo vuelo</p>";
} else{
    echo "<p>Ha habido un fallo añadiendo un nuevo vuelo./p>";
}

// modificaDestino()
echo "<h2> Actualizar un destino del viaje por la función modificaDestino()</h2>";
if (modificaDestino(3,'Valencia')){
    echo "<p>Se ha actualizado correctamente el viaje </p>";
} else{
    echo "<p>Ha habido un fallo al actualizar un vuelo.</p>";
}

// modificaCompanya()
echo "<h2> Actualizar la compañia del viaje por la función ModificaCompanya()</h2>";
if (modificaCompanya(3,'Ryanair')){
    echo "<p>Se ha actualizado correctamente el viaje </p>";
} else{
    echo "<p>Ha habido un fallo al actualizar un vuelo.</p>";
}

echo "<h2>Eliminar un viaje con la función eliminaVuelo()</h2>";
if (eliminaVuelo(3)){
    echo "<p>Se ha borrado correctamente el viaje </p>";
} else{
    echo "<p>Ha habido un fallo al borrar el vuelo.</p>";
}

echo "<h2> Mirar los vuelos con la función extraeVuelos()</h2>";
extraeVuelos();
?>
</body>
</html>