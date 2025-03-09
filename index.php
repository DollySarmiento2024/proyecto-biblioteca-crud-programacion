<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio AP63 CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form class="agregar-form" action="" method="post">
        <input type="hidden" name="action" value="add">

        <h1>Gestor de Bibliotecas</h1>
        <h2>Añadir publicaciones (libro o revistas)</h2>

        <div>
            <label for="categoria">Selecciona:</label>
            <input type="radio" name="categoria" value="libro" checked>Libro
            <input type="radio" name="categoria" value="revista">Revista
        </div>

        <div>
            <label for="titulo">Titulo:</label>
            <input class="input_text" type="text" name="titulo" id="titulo" required>
        </div>
        <div>
            <label for="autor">Autor:</label>
            <input class="input_text" type="text" name="autor" id="autor" required>
        </div>
        <div>
            <label for="anyo">Año:</label>
            <input class="input_text" type="number" name="anyo" id="anyo" min="0" minlength="4" required>
        </div>
        <div>
            <label for="paginas">Paginas:</label>
            <input class="input_text" type="number" name="paginas" id="paginas" min="0" required>
        </div>
        <div>
            <label for="tematica">Tematica:</label>
            <input class="input_text" type="text" name="tematica" id="tematica">
        </div>
        <div>
            <input class="button" type="submit" name="agregar" value="Añadir publicación">
        </div>
    </form>

    <?php
    require_once("./class/Manager.php");
    echo "<h2>Sistema de Gestión de Libros y revistas </h2>";
    $manager = new Manager();

    echo "<h2>Listado de Libros</h2>";

    if (count($manager->leerLibros()) == 0) {
        echo "<p>No hay Libros registrados.</p>";
    } else {
        echo "<ul>";
        foreach ($manager->leerLibros() as $index => $libro) {
            echo "<li>";
            echo "<p>Titulo: " . $libro->getTitulo() . ", Autor: " . $libro->getAutor() . "Anyo: " . $libro->getAnyo() . "</p>";
            echo "<form method='POST' class='eliminar-form'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='categoria' value='libro'>
                        <input type='hidden' name='index' value='" . $index . "'>
                        <input class='button' type='submit' name='eliminar' value='Eliminar'>
                    </form>";
            echo "</li>";
        }
        echo "</ul>";
    }

    echo "<h2>Listado de Revista</h2>";
    if (count($manager->leerRevistas()) == 0) {
        echo "<p>No hay revistas registrados</p>";
    } else {
        echo "<ul>";
        foreach ($manager->leerRevistas() as $index => $revista) {
            echo "<li>";
            echo "<p>Titulo:" . $revista->getTitulo() . ", Autor: " . $revista->getAutor() . "Anyo: " . $revista->getAnyo() . "Tematica: " . $revista->getTematica() . "</p>";
            echo "<form method='POST' class='eliminar-form'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='categoria' value='revista'>
                            <input type='hidden' name='index' value='" . $index . "'>
                            <input class='button' type='submit' name='eliminar' value='Eliminar'>
                        </form>";
            echo "</li>";
        }
        echo "</ul>";
    }

    /* echo "<article>";
    echo "<h3>LIBROS:</h3>";
    $manager->leerLibros();
    echo "</article>";
   
    echo "<article>";
    echo "<h3>REVISTAS:</h3>";
    $manager->leerRevistas();
    echo "</article>"; */

    if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['action'])) {
        $action = $_POST['action'] ?? '';

        switch ($action) {
            
            //AGREGAR
            case 'add':
                $titulo = $_POST['titulo'] ?? '';
                $autor = $_POST["autor"] ?? '';
                $anyo = (int)($_POST["anyo"] ?? 0);
                $paginas = (int)($_POST["paginas"] ?? 0);
                $tematica = $_POST["tematica"] ?? '';
                $categoria = $_POST["categoria"] ?? '';


                if (!empty($titulo) && !empty($autor) && !empty($anyo) && !empty($paginas)) {
                    switch ($categoria) {
                        case 'revista':
                            if (!empty($tematica)) {
                                $manager->crearRevista($titulo, $autor, $anyo, $paginas, $tematica);
                            } else {
                                echo "<p>Por favor, completa todos los campos correctamente.<p>";
                            }
                            break;
                        case 'libro':
                            $manager->crearLibro($titulo, $autor, $anyo, $paginas);
                            break;
                    }
                } else {
                    echo "<p>Por favor, completa todos los campos correctamente.<p>";
                }
                break;

            //ELIMINAR
            case 'delete':
                $index = (int)($_POST['index'] ?? -1);
                if ($index >= 0) {
                    if (isset($_POST['categoria']) && $_POST['categoria'] == 'libro') {
                        $manager->eliminarLibro($index);
                        echo "<p>Libro eliminado correctamente.</p>";
                    } else {
                        $manager->eliminarRevista($index);
                        echo "<p>Revista eliminada correctamente.</p>";
                    }
                }
                break;
        }
    }

    /* http://localhost:8080/AP63_Formulario */
    ?>
</body>
</html>

<!-- 
LIBROS
1. Título: Cien Años de Soledad, Autor: Gabriel García Márquez, Año: 1967, paginas: 496
2. Título: Don Quijote de la Mancha, Autor: Miguel de Cervantes, Año: 1605, paginas: 462  

REVISTAS
1. Título: "Letras Libres", autor: "Enrique Krauze", Año: 1999, paginas: 100, tematica: "entrevistas"
2. Título: "The Effect of Neuromarketing Techniques on Consumer Behavior", Autor: "Ariely, D. & Berns", anyo: 2010, "paginas": 233, tematica: "Neuromarketing"

-->