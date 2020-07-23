<?php

namespace Source\Models;

use DateTime;

class CupomDesconto implements \Source\Interfaces\iMetMagic
{
    private ?int $id = null;
    private ?float $percentual = null;
    private ?bool $ativo = null;
    private ?DateTime $dtEmissao;
    private ?DateTime $dtValidade;
    private $error;

    //Getters e Setters
    public function setCupomDesconto(int $id, float $percentual, bool $ativo, ?DateTime $dtEmissao = null, ?DateTime $dtValidade = null)
    {
        $this->setId($id);
        $this->setPercentual($percentual);
        $this->setAtivo($ativo);
        $this->setDtEmissao($dtEmissao);
        $this->setDtValidade($dtValidade);
    }

    public function getDtEmissao(): ?DateTime
    {
        return $this->dtEmissao;
    }

    private function setDtEmissao(DateTime $dtEmissao)
    {
        $this->dtEmissao =  $dtEmissao;
    }

    public function getDtValidade(): ?DateTime
    {
        return $this->dtValidade;
    }

    private function setDtValidade(DateTime $dtValidade)
    {
        $this->dtValidade = $dtValidade;
    }

    public function getPercentual(): ?float
    {
        return $this->percentual;
    }

    private function setPercentual($percentual)
    {
        $this->percentual = filter_var($percentual, FILTER_SANITIZE_STRIPPED);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    private function setId($id)
    {
        $this->id = filter_var($id, FILTER_SANITIZE_STRIPPED);
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    private function setAtivo($ativo)
    {
        $this->ativo = filter_var($ativo, FILTER_SANITIZE_STRIPPED);
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
