<?php

namespace Source\Models;

class Item implements \Source\Interfaces\iMetMagic
{
    private ?int $seq = null;
    private ?int $produtoId = null;
    private ?float $qtde = null;
    private ?float $pUnit = null;
    private $error;

    public function __construct($seq, $produtoId, $qtde, $pUnit)
    {
        $this->setSeq($seq);
        $this->setProdutoId($produtoId);
        $this->setQtde($qtde);
        $this->setPUnit($pUnit);
    }

    //Getters e Setters
    public function getPTotal(): ?float
    {
        return $this->qtde * $this->pUnit;
    }

    public function getQtde(): ?float
    {
        return $this->qtde;
    }

    private function setQtde($qtde)
    {
        $this->qtde = filter_var($qtde, FILTER_SANITIZE_STRIPPED);
    }

    public function setItem($seq, $produtoId, $pUnit)
    {
        $this->setSeq($seq);
        $this->setProdutoId($produtoId);
        $this->setPUnit($pUnit);

        return true;
    }

    public function getSeq(): ?int
    {
        return $this->seq;
    }

    private function setSeq($seq)
    {
        $this->seq = filter_var($seq, FILTER_SANITIZE_STRIPPED);
    }

    public function getProdutoId(): ?int
    {
        return $this->produtoId;
    }

    private function setProdutoId($produtoId)
    {
        $this->produtoId = filter_var($produtoId, FILTER_SANITIZE_STRIPPED);
    }

    public function getPUnit(): ?float
    {
        return $this->pUnit;
    }

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
