<?php

namespace Source\Models;

class Restaurante implements \Source\Interfaces\iMetMagic
{
    private Clientes $clientes;
    private Produtos $produtos;
    private Pedidos $pedidos;
    private CuponsDesconto $cuponsDesconto;
    private $error;

    public function getCuponsDesconto(): CuponsDesconto
    {
        return $this->cuponsDesconto;
    }

    public function setCuponsDesconto($cuponsDesconto)
    {
        $this->cuponsDesconto = $cuponsDesconto;
    }

    public function getClientes(): Clientes
    {
        return $this->clientes;
    }

    public function setClientes($clientes)
    {
        $this->clientes = $clientes;
    }

    public function getProdutos(): Produtos
    {
        return $this->produtos;
    }

    public function setProdutos($produtos)
    {
        $this->produtos = $produtos;
    }

    public function setPedidos($pedidos)
    {
        $this->pedidos = $pedidos;
    }

    public function getPedidos(): Pedidos
    {
        return $this->pedidos;
    }


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
