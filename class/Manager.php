<?php

require_once("Libro.php");
require_once("Revista.php");

//Clase que administra el CRUD de libros
class Manager
{
    private array $libros = [];
    private array $revistas = [];
   
    //Crear: Agregar un libro
    public function crearLibro(string $titulo, string $autor, int $anyo, int $paginas): void
    {
        $libro = new Libro($titulo, $autor, $anyo, $paginas);
        $this->libros[] = $libro;
        echo "Libro '$titulo' agregado correctamente . <br>";
    }

    //Crear: Agregar una revista
    public function crearRevista(string $titulo, string $autor, int $anyo, int $paginas, string $tematica): void
    {
        $revista = new Revista($titulo, $autor, $anyo, $paginas, $tematica);
        $this->revistas[] = $revista;
        echo "Revista '$titulo' agregado correctamente . <br>";
    }

    //leer: listar todos los libros
    public function leerLibros(): void
    {
        if (empty($this->libros)) {
            echo "No hay libros registrados . <br>";
            return;
        }

        echo "Listado de libros: <br>";
        foreach ($this->libros as $index => $libro) {
            echo ($index + 1) . ". Título: " . $libro->getTitulo() . ", Autor" . $libro->getAutor() . ", Año: " . $libro->getAnyo() . ", Paginas: " . $libro->getPaginas() . "<br>";
        }
    }

    //leer: listar todos las revistas
    public function leerRevistas(): void
    {
        if (empty($this->revistas)) {
            echo "No hay revistas registradas . <br>";
            return;
        }

        echo "Listado de revistas: <br>";
        foreach ($this->revistas as $index => $revista) {
            echo ($index + 1) . ". Título: " . $revista->getTitulo() . ", Autor" . $revista->getAutor() . ", Año: " . $revista->getAnyo() . ", Paginas: " .  $revista->getPaginas() . ", Tematica: " . $revista->getTematica() . "<br>";
        }
    }

    // actualizar: Modificar un libro por índice
    public function actualizarLibro(int $index, string $newTitulo, string $newAutor, int $newAnyo, int $newPaginas)
    {
        if (!isset($this->libros[$index])) {
            echo "Libro no encontrado.<br>";
            return;
        }

        $libro = $this->libros[$index];
        $libro->setTitulo($newTitulo);
        $libro->setAutor($newAutor);
        $libro->setAnyo($newAnyo);
        $libro->setPaginas($newPaginas);
        echo "Libro actualizado correctamente . <br>";
    }

    // actualizar: Modificar una revista por índice
    public function actualizarRevista(int $index, string $newTitulo, string $newAutor, int $newAnyo, int $newPaginas, string $newTematica)
    {
        if (!isset($this->revistas[$index])) {
            echo "Revista no encontrado.<br>";
            return;
        }

        $revista = $this->revistas[$index];
        $revista->setTitulo($newTitulo);
        $revista->setAutor($newAutor);
        $revista->setAnyo($newAnyo);
        $revista->setPaginas($newPaginas);
        $revista->setTematica($newTematica);
        echo "Revista actualizada correctamente . <br>";
    }

    //Delete:Eliminar un libro por índice
    public function eliminarLibro(int $index): void
    {
        if (!isset($this->libros[$index])) {
            echo "Libro no encontrado.<br>";
            return;
        }

        $eliminarLibro = $this->libros[$index]->getTitulo();
        unset($this->libros[$index]);
        $this->libros = array_values($this->libros); // Reindexar array
        echo "Libro '$eliminarLibro' eliminado correctamente . <br>";
    }

    //Delete:Eliminar un libro por índice
    public function eliminarRevista(int $index): void
    {
        if (!isset($this->revistas[$index])) {
            echo "Revista no encontrada.<br>";
            return;
        }

        $eliminarRevista = $this->revistas[$index]->getTitulo();
        unset($this->revistas[$index]);
        $this->revistas = array_values($this->revistas); // Reindexar array
        echo "Revista '$eliminarRevista' eliminado correctamente . <br>";
    }
}
