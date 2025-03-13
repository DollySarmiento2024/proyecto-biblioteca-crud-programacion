<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio AP63 CRUD Biblioteca V</title>
    <img src="./Imagen/biblioteca.jpg" alt="biblioteca" style="width: 100%; max-height: 300px;">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Gestor de Bibliotecas</h1>

    <a href="indexLibros.php"><button>LISTADO DE LIBROS-></button></a>
    <a href="indexRevistas.php"><button>LISTADO DE REVISTAS-></button></a>
    
    <h2>Añadir Publicación (Libro o Revista)</h2>

    <form class="agregar-form" action="" method="post">
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

    $manager = new Manager();

    //CREAR LIBRO O REVISTA
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        //$action = $_POST['action'] ?? '';
        $categoria = $_POST["categoria"] ?? '';
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST["autor"] ?? '';
        $anyo = (int)($_POST["anyo"] ?? 0);
        $paginas = (int)($_POST["paginas"] ?? 0);
        $tematica = $_POST["tematica"] ?? '';

        if (!empty($titulo) && !empty($autor) && !empty($anyo) && !empty($paginas)) 
        {
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

    }


    /*http://localhost:8080/AP63_CRUD_Biblioteca_V/form.php */
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