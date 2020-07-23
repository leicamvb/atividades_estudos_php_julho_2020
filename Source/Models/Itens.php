<?php

namespace Source\Models;


/**
 * Note: 
 * 
 * ?Typed Declaração de tipo de retorno anulável (a partir do PHP 7.1.0)
 * 
 * Declaring a collection of objects as return type is not implemented and forbidden:
 * https://www.php.net/manual/pt_BR/functions.returning-values.php#functions.returning-values.type-declaration
 */

class Itens implements \Source\Interfaces\iMetMagic
{
    private $itens = [];

    public function lastSeq(): int
    {
        (int) $lastSeq = 0;

        foreach ($this->itens as $dataRow) {
            if ($dataRow->getSeq() > $lastSeq) {
                $lastSeq = $dataRow->getSeq();
            }
        }
        return (int) $lastSeq;
    }

    public function add(Item ...$params): void
    {
        $args = func_get_args();

        foreach ($args as $dataRow) {
            $this->itens[] = $dataRow;
        }
    }

    public function all(): array
    {
        return $this->itens;
    }

    public function findById(int $seq): ?Item
    {
        $rows = [];
        foreach ($this->itens as $dataRow) {
            if ($dataRow->getSeq() === $seq) {
                return $dataRow;
            }
        }

        return null;
    }

    public function remove(int $seq)
    {
        $rows = [];
        foreach ($this->itens as $dataRow) {
            if ($dataRow->getSeq() === $seq) {
                $rows[] = $dataRow;
                unset($this->itens[array_search($dataRow, $this->itens, true)]);
            }
        }
    }

    public function getQtdeTotal(): float
    {
        (float) $qtdeTotal = 0;
        foreach ($this->itens as $dataRow) {
            $qtdeTotal += $dataRow->getQtde();
        }
        return (float) $qtdeTotal;
    }

    public function getPTotal(): float
    {
        (float) $pTotal = 0;
        foreach ($this->itens as $dataRow) {
            $pTotal += $dataRow->getPTotal();
        }
        return (float) $pTotal;
    }

    public function getNumItens(): int
    {
        return (int) sizeof($this->itens);
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
