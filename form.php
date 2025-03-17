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
3. Titulo: 1984, Autor: George Orwell, Año: 1949, Paginas: 328
4. Titulo: El gran Gatsby, Autor: F. Scott Fitzgerald, Año: 1925, Paginas: 180
5. Titulo: Orgullo y prejuicio, Autor: Jane Austen, Año: 1813, Paginas: 432
6. Titulo: Matar a un ruiseñor, Autor: Harper Lee, Año: 1960, Paginas: 281
7. Titulo: El Hobbit, Autor: J.R.R. Tolkien, Año: 1937, Paginas: 310
8. Titulo: La sombra del viento, Autor: Carlos Ruiz Zafón, Año: 2001, Paginas: 576
9. Titulo: Los detectives salvajes, Autor: Roberto Bolaño, Año: 1998, Paginas: 576


REVISTAS
1. Título: "Letras Libres", autor: "Enrique Krauze", Año: 1999, paginas: 100, tematica: "entrevistas"
2. Título: "The Effect of Neuromarketing Techniques on Consumer Behavior", Autor: "Ariely, D. & Berns", anyo: 2010, "paginas": 233, tematica: "Neuromarketing"
3. Titulo: Time, Autor: Varios autores, Año: 1923, Paginas: 70, Tematica: Noticias
4. Titulo: Vogue, Autor: Varios autores, Año: 1892, Paginas: 250, Tematica: Moda
5. Titulo: Scientific American, Autor: Varios autores, Año: 1845, Paginas: 70, Tematica: Ciencia
6. Titulo: The Economist, Autor: Varios autores, Año: 1843, Paginas: 90, Tematica: Política
7. Titulo: Elle, Autor: Varios autores, Año: 1945, Paginas: 200, Tematica: Moda
8. Titulo: Harvard Business Review, Autor: Varios autores, Año: 1922, Paginas: 80, Tematica: Negocios
9. Titulo: The Atlantic, Autor: Varios autores, Año: 1857, Paginas: 100, Tematica: Cultura
-->