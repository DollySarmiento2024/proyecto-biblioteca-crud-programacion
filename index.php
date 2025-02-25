<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio AP63 CRUD Biblioteca II</title>
</head>

<body>

    <?php
    require_once("./class/Manager.php");

    //ejemplo de uso
    echo "---Sistema de Gestión de Libros y revistas ----<br><br>";
    $manager = new Manager();

    echo "---LIBROS: ----<br><br>";

    $manager->crearLibro("Cien Años de Soledad", "Gabriel García Márquez", 1967, 220);
    $manager->crearLibro("Don Quijote de la Mancha", "Miguel de Cervantes", 1605, 450);
    $manager->leerLibros();

    $manager->actualizarLibro(1, "Don Quijote (Edición Revisada)", "Miguel de Cervantes", 1615,350);
    $manager->leerLibros();

    $manager->eliminarLibro(index: 0);
    $manager->leerLibros();

    /*----------------------------------------------------------------------------------------------------------*/
    echo "<br>---REVISTAS: ----<br><br>";

    $manager->crearRevista("The Effect of Neuromarketing Techniques on Consumer Behavior", "Ariely, D. & Berns, G. S.", 2010, 233, "Neuromarketing");
    $manager->crearRevista("El papel de la gamificación en la motivación estudiantil", "Rodríguez, A. & Pérez, C.", 2019, 180, "Pedagogía y Tecnología");
    $manager->leerRevistas();

    $manager->actualizarRevista(1, "El papel de la gamificación en la motivación estudiantil (segunda edición)", "Rodríguez, A. & Pérez", 2024, 260, "psicología");
    $manager->leerRevistas();

    $manager->eliminarRevista(0);
    $manager->leerRevistas();

    /*
    http://localhost:8080/Proyecto_github_CRUD_Biblioteca_PHP/

    ---Sistema de Gestión de Libros y revistas ----

    ---LIBROS: ----

    Libro 'Cien Años de Soledad' agregado correctamente .
    Libro 'Don Quijote de la Mancha' agregado correctamente .
    Listado de libros:
    1. Título: Cien Años de Soledad, AutorGabriel García Márquez, Año: 1967, Paginas: 220
    2. Título: Don Quijote de la Mancha, AutorMiguel de Cervantes, Año: 1605, Paginas: 450
    Libro actualizado correctamente .
    Listado de libros:
    1. Título: Cien Años de Soledad, AutorGabriel García Márquez, Año: 1967, Paginas: 220
    2. Título: Don Quijote (Edición Revisada), AutorMiguel de Cervantes, Año: 1615, Paginas: 350
    Libro 'Cien Años de Soledad' eliminado correctamente .
    Listado de libros:
    1. Título: Don Quijote (Edición Revisada), AutorMiguel de Cervantes, Año: 1615, Paginas: 350

    ---REVISTAS: ----

    Revista 'The Effect of Neuromarketing Techniques on Consumer Behavior' agregado correctamente .
    Revista 'El papel de la gamificación en la motivación estudiantil' agregado correctamente .
    Listado de revistas:
    1. Título: The Effect of Neuromarketing Techniques on Consumer Behavior, AutorAriely, D. & Berns, G. S., Año: 2010, Paginas: 233, Tematica: Neuromarketing
    2. Título: El papel de la gamificación en la motivación estudiantil, AutorRodríguez, A. & Pérez, C., Año: 2019, Paginas: 180, Tematica: Pedagogía y Tecnología
    Revista actualizada correctamente .
    Listado de revistas:
    1. Título: The Effect of Neuromarketing Techniques on Consumer Behavior, AutorAriely, D. & Berns, G. S., Año: 2010, Paginas: 233, Tematica: Neuromarketing
    2. Título: El papel de la gamificación en la motivación estudiantil (segunda edición), AutorRodríguez, A. & Pérez, Año: 2024, Paginas: 260, Tematica: psicología
    Revista 'The Effect of Neuromarketing Techniques on Consumer Behavior' eliminado correctamente .
    Listado de revistas:
    1. Título: El papel de la gamificación en la motivación estudiantil (segunda edición), AutorRodríguez, A. & Pérez, Año: 2024, Paginas: 260, Tematica: psicología

    */


    ?>
</body>

</html>