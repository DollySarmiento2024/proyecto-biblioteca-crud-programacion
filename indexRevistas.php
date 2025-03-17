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

    $revistas = $manager->leerRevistas();
    $total_revistas = count($revistas);
    $revistas_por_pag = 3;
    $total_paginas = ceil(count($revistas) / $revistas_por_pag);

    //obtener el número de página actual
    $paginas = isset($_GET['paginas']) ? (int)$_GET['paginas'] : 1;
    //limitamos el número máximo de páginas
    if($paginas > $total_paginas)
    {
        $paginas = $total_paginas;
    }

    //Calcular el índice inicial y final para la paginación
    $indice_inicio = ($paginas - 1) * $revistas_por_pag;
    $mostrar_revista = array_slice($revistas, $indice_inicio, $revistas_por_pag);


    //LISTAR REVISTA
    if ($total_revistas == 0) {
        echo "<p>No hay revistas registrados</p>";
    } else {
        echo "<ul>";
        foreach ($mostrar_revista as $index => $revista) {
            echo "<li>";
            echo "<p><span>Titulo:</span> " . $revista->getTitulo() . ", <span>Autor:</span> " . $revista->getAutor() . ", <span>Año:</span> " . $revista->getAnyo() . ", <span>Paginas:</span> " . $revista->getPaginas() . ", <span>Tematica:</span> " . $revista->getTematica() . "</p>";

            echo "<form method='POST' class='eliminar-form'>
                            <input type='hidden' name='index' value='" . ($indice_inicio + $index) . "'>
                            <input class='button' type='submit' name='eliminar' value='Eliminar'>
                        </form>";
            echo "</li>";
        }
        echo "</ul>";

        /* paginación */
        echo "<div class='paginacion'>";

        if ($paginas > 1) {
            echo "<a href='?paginas=1'> << </a>";  // Corrección: eliminé espacios extra
            echo "<a href='?paginas=" . ($paginas - 1) . "'> < </a>";
        }

        echo "<span>Página " . $paginas . " de "  . $total_paginas . "</span>";

        if ($paginas < $total_paginas) {
            echo "<a href='?paginas=" . ($paginas + 1) . "'> > </a>";
            echo "<a href='?paginas=" . $total_paginas . "'> >> </a>";
        }
        echo "</div>";

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