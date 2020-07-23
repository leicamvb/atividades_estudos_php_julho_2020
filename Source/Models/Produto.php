<?php

namespace Source\Models;

class Produto implements \Source\Interfaces\iMetMagic
{
    private ?int $id = null;
    private ?string $descricao = null;
    private ?float $pUnit = null;
    private $error;

    //Getters e Setters
    public function setProduto($id, $descricao, $pUnit)
    {
        $this->setId($id);
        $this->setDescricao($descricao);

        if (!$this->pUnit < 0) {
            $this->error = "O preço unitário {$this->getPUnit()} não é válido!";
            return false;
        } else {
            $this->setPUnit($pUnit);
        }

        return true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    private function setId($id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_STRIPPED);
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    private function setDescricao($descricao)
    {
        $this->descricao = filter_var($descricao, FILTER_SANITIZE_STRIPPED);
    }

    public function getPUnit(): ?float
    {
        return number_format($this->pUnit, "2", ".", ",");
    }

    // Valida o e-mail do usuário em um formato válido!
    private function setPUnit($pUnit)
    {
        $this->pUnit = filter_var($pUnit, FILTER_SANITIZE_STRIPPED);
    }
    //Fim dos Getters e Setters


    /**
     * Implementação dos métodos mágicos do PHP
     * para evitar a chamada de métodos inexistentes
     */
    public function __set($name, $value)
    {
        $this->notFound(__FUNCTION__, $name);
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        $this->notFound(__FUNCTION__, $name);
    }

    private function notFound($method, $name)
    {
        echo "<p class='trigger error'>{$method}: A propriedade {$name} não existe em " . __CLASS__ . "!</p>";
    }

    public function getError()
    {
        return $this->error;
    }
}
