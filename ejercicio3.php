<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<style>
    table{
        width: 100%;
    }
    table, tr, td, th{
        border: 1px solid black;
        text-align: center;
    }
</style>
<body>
<h1>Ejercicio 3 - XML</h1>
<h4>Se agregará un libro nuevo cada vez que recargues la página.</h4>
<?php
// XML

// Comprobamos antes si el ficher existe
if (file_exists('fichero.xml')) {
    $xml = simplexml_load_file('fichero.xml'); // De existir, lo cargamos
    
    // Vamos a sacar primero el segundo libro, si fuese un array, sería el [1]
    // Datos del segundo libro:
    $i = 0;
    $Autor;
    $Titulo;
    $Genero;
    $Precio;
    $FechaDePublicacion;
    $Descripcion;

    foreach ($xml->book[1] as $V) {
        if ($i == 0 ){ // Autor
            $Autor = $V;
        }
        if ($i == 1 ){ // Titulo
            $Titulo = $V;
        }
        if ($i == 2 ){ // Genero
            $Genero = $V;
        }
        if ($i == 3 ){ // Precio
            $Precio = $V;
        }
        if ($i == 4 ){ // Fecha de publicación
            $FechaDePublicacion = $V;
        }
        if ($i == 5 ){ // Descripcion
            $Descripcion = $V;
        }
        $i++;
    }
    // Mostrar ahora el libro 2 en pantalla
    echo "<h2>Libro 2 del XML:</h2>";
    echo "<h3>$Titulo</h3>";
    echo "<p>Author: $Autor<br> Genre: $Genero<br>";
    echo "Publish Date: $FechaDePublicacion<br> Price: $Precio</p>";
    echo "<p>Description: $Descripcion</p>";

    // Ahora crearemos la tabla con todos los libros
    ?>
    <h2>Tabla con todos los libros existentes:</h2>
    <table>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Género</th>
            <th>Precio</th>
            <th>Fecha de publicación</th>
            <th>Descripción</th>
            <th>ID</th>
        </tr>
    <?php
    foreach ($xml->book as $V) {
       $ID = $V["id"];
       echo "<tr>";
       $i = 0;
       foreach ($V as $V2) {
            if ($i == 0 ){ // Autor
                $Autor = $V2;
            }
            if ($i == 1 ){ // Titulo
                $Titulo = $V2;
            }
            if ($i == 2 ){ // Genero
                $Genero = $V2;
            }
            if ($i == 3 ){ // Precio
                $Precio = $V2;
            }
            if ($i == 4 ){ // Fecha de publicación
                $FechaDePublicacion = $V2;
            }
            if ($i == 5 ){ // Descripcion
                $Descripcion = $V2;
            }
            $i++;
       }
       echo "<td>$Titulo</td>";
       echo "<td>$Autor</td>";
       echo "<td>$Genero</td>";
       echo "<td>$Precio</td>";
       echo "<td>$FechaDePublicacion</td>";
       echo "<td>$Descripcion</td>";
       echo "<td>$ID</td>";
       echo "</tr>";
    }
    echo "</table>";
} else {
    exit('Ha habido un error abriendo fichero XML.');
}
// Ahora, añadiremos un nuevo valor (book) al xml con todos sus elementos y atributos
$hijo=$xml->addChild("book", "");
$subhijo = $hijo->addChild("author", "Laura Gallego");
$subhijo = $hijo->addChild("title", "Cronicas de la Torre I");
$subhijo = $hijo->addChild("genre", "Fantasy");
$subhijo = $hijo->addChild("price", "9.45");
$subhijo = $hijo->addChild("publish_date", "2000");
$subhijo = $hijo->addChild("description", "Es la historia de una niña, Dana, que vive en una granja y tiene un amigo que se llama Kai. Hasta aquí, todo normal. El problema es que Kai es invisible para todos excepto para Dana, y ni siquiera ella lo puede tocar.");
$subhijo = $hijo->addAttribute("id", "bk113");
$xml->asXML("./fichero.xml");
?>
</body>
</html>