<?php
//La clase Libro que heradará de Publicacion y tendrá además la propiedad paginas.
require_once("Publicacion.php");

class Libro extends Publicacion
{

    protected int $paginas;


    public function __construct(string $titulo, string $autor, int $anyo, int $paginas)
    {
        parent::__construct($titulo, $autor, $anyo);
        $this->paginas = $paginas;
    }

    
    /**
     * Get the value of paginas
     */
    public function getPaginas()
    {
        return $this->paginas;
    }

    /**
     * Set the value of paginas
     */
    public function setPaginas(int $paginas)
    {
        $this->paginas = $paginas;

    }

    public function toArray(): array {
        return [
            'titulo'=> $this->titulo,
            'autor'=> $this->autor,
            'anyo'=> $this->anyo,
            'paginas'=>$this->paginas
        ];
    }

    public static function fromArray(array $data): Libro {
        return new Libro($data['titulo'], $data['autor'], $data['anyo'], $data['paginas']);
    }
}



?>