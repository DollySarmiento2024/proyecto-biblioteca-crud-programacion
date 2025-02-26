<?php
require_once("Libro.php");
require_once("Revista.php");

//Clase que administra el CRUD de libros
class Manager
{
    private array $libros = [];
    private array $revistas = [];
    private string $filePathLibros = 'datos_libros.json';
    private string $filePathRevistas = 'datos_revistas.json';

    public function __construct()
    {
        $this->cargarLibros();
        $this->cargarRevistas();
    }

    private function cargarLibros(): void
    {
        $data = null;
        if (file_exists($this->filePathLibros)) {
            $data = json_decode(file_get_contents($this->filePathLibros), true);
        }
        if ($data != null && is_array($data)) {
            foreach ($data as $array) {
                $this->libros[] = Libro::fromArray($array);
            }
        }
    }

    /*-----------------------------------------------------------------------*/

    private function cargarRevistas(): void
    {
        $data = null;
        if (file_exists($this->filePathRevistas)) {
            $data = json_decode(file_get_contents($this->filePathRevistas), true);
        }
        if ($data != null && is_array($data)) {
            foreach ($data as $array) {
                $this->revistas[] = Revista::fromArray($array);
            }
        }
    }

    /*-----------------------------------------------------------------------*/

    public function crearLibro(string $titulo, string $autor, int $anyo, int $paginas): void
    {
        $libro = new Libro($titulo, $autor, $anyo, $paginas);
        $this->libros[] = $libro;
        $this->guardarLibros();
    }

    /*-----------------------------------------------------------------------*/

    public function crearRevista(string $titulo, string $autor, int $anyo, int $paginas, string $tematica): void
    {
        $revista = new Revista($titulo, $autor, $anyo, $paginas, $tematica);
        $this->revistas[] = $revista;
        $this->guardarRevistas();
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
        $this->guardarLibros();

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
        $this->guardarRevistas();
    }

    /*-----------------------------------------------------------------------*/
    
    public function eliminarLibro(int $index): void
    {
        if (isset($this->libros[$index])) 
        {
            unset($this->libros[$index]);
            $this->libros = array_values($this->libros);
            $this->guardarLibros();
        }
    }

    /*-----------------------------------------------------------------------*/
    
    public function eliminarRevista(int $index): void
    {
        if (isset($this->revistas[$index])) 
        {
            unset($this->revistas[$index]);
            $this->revistas = array_values($this->revistas);
            $this->guardarRevistas();
        }
    }

    /*-----------------------------------------------------------------------*/

    private function guardarLibros(): void
    {
        $jsonBiblio = [];
        foreach ($this->libros as $object) {
            $arrayLibro = $object->toArray();
            $jsonBiblio[] = $arrayLibro;
        }
        $jsonBiblio = json_encode($jsonBiblio, JSON_PRETTY_PRINT);
        file_put_contents($this->filePathLibros, $jsonBiblio);
    }

    /*-----------------------------------------------------------------------*/
    private function guardarRevistas(): void
    {
        $jsonBiblio = [];
        foreach ($this->revistas as $object) {
            $arrayRevista = $object->toArray();
            $jsonBiblio[] = $arrayRevista;
        }
        $jsonBiblio = json_encode($jsonBiblio, JSON_PRETTY_PRINT);
        file_put_contents($this->filePathRevistas, $jsonBiblio);
    }
}
