<?php
//La clase Revista que heredará de Libro y tendrá además la propiedad tematica

require_once("Libro.php");

class Revista extends Libro
{
    private string $tematica;
    
    public function __construct(string $titulo, string $autor, int $anyo, int $paginas, string $tematica){
        parent::__construct($titulo, $autor, $anyo, $paginas);
        $this->tematica = $tematica;
    }

    /**
     * Get the value of tematica
     */
    public function getTematica()
    {
        return $this->tematica;
    }

    /**
     * Set the value of tematica
     */
    public function setTematica(string $tematica)
    {
        $this->tematica = $tematica;

    }

    public function toArray(): array {
        return [
            'titulo'=> $this->titulo,
            'autor'=> $this->autor,
            'anyo'=> $this->anyo,
            'paginas'=>$this->paginas,
            'tematica'=>$this->tematica
        ];
    }

    public static function fromArray(array $data): Revista {
        return new Revista($data['titulo'], $data['autor'], $data['anyo'], $data['paginas'], $data['tematica']);
    }
   
}

?>