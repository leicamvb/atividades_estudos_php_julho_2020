<?php

namespace Source\Models;

class Pedido implements \Source\Interfaces\iMetMagic
{
    private ?int $id = null;
    private ?string $status = null;
    private ?int $clienteID = null;
    private ?float $frete = 0;
    private ?int $cupomId = null;
    private ?float $percentualDesconto = null;
    public Itens $itens;
    private $error;

    public function __construct()
    {
        $this->itens = new Itens();
    }
    //Getters e Setters

    public function getCupomDesconto(): ?int
    {
        return $this->cupomId;
    }

    private function setCupomDesconto(CupomDesconto $cupomDesconto)
    {
        $this->cupomId = filter_var($cupomDesconto->getId(), FILTER_SANITIZE_STRIPPED);
        $this->setPercentualDesconto(filter_var($cupomDesconto->getPercentual(), FILTER_SANITIZE_STRIPPED));
    }

    public function getPercentualDesconto(): ?float
    {
        return $this->percentualDesconto;
    }

    private function setPercentualDesconto($percentualDesconto)
    {
        $this->percentualDesconto = filter_var($percentualDesconto, FILTER_SANITIZE_STRIPPED);
    }

    public function getValorDesconto(): ?float
    {
        $valorDesconto = ($this->itens->getPTotal() / 100) * $this->getPercentualDesconto();
        return $valorDesconto;
    }

    public function getItens()
    {
        return $this->itens;
    }

    public function setItens(Itens $itens)
    {
        $this->itens = $itens;
    }

    public function addItem(Item ...$params): void
    {
        $args = func_get_args();

        foreach ($args as $dataRow) {
            $this->itens->add($dataRow);
        }
    }

    public function setPedido($id, $status, $clienteID, $frete = null, CupomDesconto $cupomDesconto = null)
    {
        $this->setId($id);
        $this->setStatus($status);
        $this->setClienteID($clienteID);

        if ($frete != null) {
            $this->setFrete($frete);
        }

        if ($cupomDesconto != null) {
            $this->setCupomDesconto($cupomDesconto);
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    private function setStatus($status)
    {
        $this->status = filter_var($status, FILTER_SANITIZE_STRIPPED);
    }

    public function getClienteID(): ?int
    {
        return $this->clienteID;
    }

    private function setClienteID($clienteID)
    {
        $this->clienteID = filter_var($clienteID, FILTER_SANITIZE_STRIPPED);
    }

    public function getValorTotal(): float
    {
        (float) $valorTotal = 0;
        $valorTotal += $this->itens->getPTotal();
        $valorTotal += $this->frete; //frete
        $valorTotal -= $this->getValorDesconto(); //desconto

        return (float) $valorTotal;
    }

    public function getQtdeTotal(): float
    {
        (float) $qtdeTotal = 0;
        $qtdeTotal += $this->itens->getQtdeTotal();

        return (float) $qtdeTotal;
    }

    public function getFrete(): float
    {
        return $this->frete;
    }

    private function setFrete($frete)
    {
        $this->frete = filter_var($frete, FILTER_SANITIZE_STRIPPED);
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
