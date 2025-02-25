<?php
 //La clase Publicacion con sus propiedades titulo, autor y anyo.

 class Publicacion 
 {
    protected string $titulo;
    protected string $autor;
    protected int $anyo;

    public function __construct(string $titulo, string $autor, int $anyo)
    {
        $this->titulo=$titulo;
        $this->autor=$autor;
        $this->anyo=$anyo;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo(string $titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Get the value of autor
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * Set the value of autor
     */
    public function setAutor(string $autor)
    {
        $this->autor = $autor;
    }

    /**
     * Get the value of anyo
     */
    public function getAnyo()
    {
        return $this->anyo;
    }

    /**
     * Set the value of anyo
     */
    public function setAnyo(int $anyo)
    {
        $this->anyo = $anyo;
    }


 }



 ?>