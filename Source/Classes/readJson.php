<?php

namespace Source\Classes;

class readJson
{

    private ?string $arquivo = null;

    public function __construct($filename)
    {
        // Atribui o conteúdo do arquivo para variável $arquivo
        $this->arquivo = file_get_contents($filename);
    }

    public function get()
    {
        // Decodifica o formato JSON e retorna um Objeto
        return $json = json_decode($this->arquivo);
    }
}
