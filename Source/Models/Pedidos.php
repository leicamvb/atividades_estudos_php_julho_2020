<?php

namespace Source\Models;

use Source\Constantes\Constantes;

/**
 * Note: 
 * 
 * ?Typed Declaração de tipo de retorno anulável (a partir do PHP 7.1.0)
 * 
 * Declaring a collection of objects as return type is not implemented and forbidden:
 * https://www.php.net/manual/pt_BR/functions.returning-values.php#functions.returning-values.type-declaration
 */

class Pedidos implements \Source\Interfaces\iMetMagic
{
    private $pedidos = [];

    public function lastId(): int
    {
        (int) $lastId = 0;

        foreach ($this->pedidos as $dataRow) {
            if ($dataRow->getId() > $lastId) {
                $lastId = $dataRow->getId();
            }
        }
        return (int) $lastId;
    }

    public function add(Pedido ...$params): void
    {
        $args = func_get_args();

        foreach ($args as $dataRow) {
            $this->pedidos[] = $dataRow;
        }
    }

    public function all(): array
    {
        return $this->pedidos;
    }

    public function findById(int $id): ?Pedido
    {
        $rows = [];
        foreach ($this->pedidos as $dataRow) {
            if ($dataRow->getId() === $id) {
                return $dataRow;
            }
        }

        return new Pedido;
    }

    public function remove(int $id)
    {
        $rows = [];
        foreach ($this->pedidos as $dataRow) {
            if ($dataRow->getId() === $id) {
                $rows[] = $dataRow;
                unset($this->pedidos[array_search($dataRow, $this->pedidos, true)]);
            }
        }
    }

    public function getValorTotalFrete(array $listStatus = null): float
    {
        (float) $valorTotalFrete = 0;
        if ($listStatus == null) $listStatus = Constantes::STATUS;
        foreach ($this->pedidos as $dataRow) {
            if (in_array($dataRow->getStatus(), $listStatus)) {
                $valorTotalFrete += $dataRow->getFrete();
            }
        }
        return (float) $valorTotalFrete;
    }

    public function getValorTotalDesconto(array $listStatus = null): float
    {
        (float) $valorTotalDesconto = 0;
        if ($listStatus == null) $listStatus = Constantes::STATUS;
        foreach ($this->pedidos as $dataRow) {
            if (in_array($dataRow->getStatus(), $listStatus)) {
                $valorTotalDesconto += $dataRow->getValorDesconto();
            }
        }
        return (float) $valorTotalDesconto;
    }

    public function getValorTotalGeral(array $listStatus = null): float
    {
        (float) $valorTotalGeral = 0;
        if ($listStatus == null) $listStatus = Constantes::STATUS;
        foreach ($this->pedidos as $dataRow) {
            if (in_array($dataRow->getStatus(), $listStatus)) {
                $valorTotalGeral += $dataRow->getValorTotal();
            }
        }
        return (float) $valorTotalGeral;
    }

    public function getQtdeTotalGeral(array $listStatus = null): float
    {
        (float) $qtdeTotalGeral = 0;
        if ($listStatus == null) $listStatus = Constantes::STATUS;
        foreach ($this->pedidos as $dataRow) {
            if (in_array($dataRow->getStatus(), $listStatus)) {
                $qtdeTotalGeral += $dataRow->getQtdeTotal();
            }
        }
        return (float) $qtdeTotalGeral;
    }


    public function getQtdePedidos(array $listStatus = null): int
    {
        (int) $count = 0;
        if ($listStatus == null) $listStatus = Constantes::STATUS;

        foreach ($this->pedidos as $dataRow) {
            if (in_array($dataRow->getStatus(), $listStatus)) $count++;
        }
        return (int) $count;
    }

    public function getQtdeStatus(array $listStatus = null): int
    {
        (int) $count = 0;
        if ($listStatus == null) $listStatus = Constantes::STATUS;

        foreach ($this->pedidos as $dataRow) {
            if (in_array($dataRow->getStatus(), $listStatus)) $count++;
        }
        return (int) $count;
    }

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
