<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listado de Revistas</title>
    <img src="./Imagen/revistas.jpg" alt="biblioteca" style="width: 100%; max-height: 300px;">
    <link rel="stylesheet" href="style.css">
</head>
</head>

<body>
    <h1>Listado de Biblioteca</h1>

    <a href="form.php"><button>GESTOR DE LIBROS Y REVISTAS</button></a>
    <h2>Listado de Revistas</h2>

    <?php
    require_once("./class/Manager.php");
    $manager = new Manager();

    //LISTAR REVISTA
    if (count($manager->leerRevistas()) == 0) {
        echo "<p>No hay revistas registrados</p>";
    } else {
        echo "<ul>";
        foreach ($manager->leerRevistas() as $index => $revista) {
            echo "<li>";
            echo "<p><span>Titulo:</span> " . $revista->getTitulo() . ", <span>Autor:</span> " . $revista->getAutor() . ", <span>Año:</span> " . $revista->getAnyo() . ", <span>Paginas:</span> " . $revista->getPaginas() . ", <span>Tematica:</span> " . $revista->getTematica() . "</p>";
            
            echo "<form method='POST' class='eliminar-form'>
                            <input type='hidden' name='index' value='" . $index . "'>
                            <input class='button' type='submit' name='eliminar' value='Eliminar'>
                        </form>";
            echo "</li>";
        }
        echo "</ul>";

        //ELIMINAR REVISTA
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $index = (int)($_POST['index'] ?? -1);
            if ($index >= 0) {
                $manager->eliminarRevista($index);
                echo "<p>Revista eliminada correctamente.</p>"; 
            } 
        }
    }
    ?>
</body>

</html>