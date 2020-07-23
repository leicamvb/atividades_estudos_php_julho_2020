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

class CuponsDesconto implements \Source\Interfaces\iMetMagic
{
    private $cuponsDesconto = [];

    public function lastId(): int
    {
        (int) $lastId = 0;

        foreach ($this->cuponsDesconto as $dataRow) {
            if ($dataRow->getId() > $lastId) {
                $lastId = $dataRow->getId();
            }
        }
        return (int) $lastId;
    }

    public function add(CupomDesconto ...$params): void
    {
        $args = func_get_args();

        foreach ($args as $dataRow) {
            $this->cuponsDesconto[] = $dataRow;
        }
    }

    public function all(): array
    {
        return $this->cuponsDesconto;
    }

    public function findById(int $id): ?CupomDesconto
    {
        $rows = [];
        foreach ($this->cuponsDesconto as $dataRow) {
            if ($dataRow->getId() === $id) {
                return $dataRow;
            }
        }

        return null;
    }

    public function remove(int $id)
    {
        $rows = [];
        foreach ($this->cuponsDesconto as $dataRow) {
            if ($dataRow->getId() === $id) {
                $rows[] = $dataRow;
                unset($this->cuponsDesconto[array_search($dataRow, $this->cuponsDesconto, true)]);
            }
        }
    }

    public function getNumCuponsDesconto(): int
    {
        return (int) sizeof($this->cuponsDesconto);
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
