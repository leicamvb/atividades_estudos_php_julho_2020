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

class Clientes implements \Source\Interfaces\iMetMagic
{
    private $clientes = [];

    public function lastId(): int
    {
        (int) $lastId = 0;

        foreach ($this->clientes as $dataRow) {
            if ($dataRow->getId() > $lastId) {
                $lastId = $dataRow->getId();
            }
        }
        return (int) $lastId;
    }

    public function add(Cliente ...$params): void
    {
        $args = func_get_args();

        foreach ($args as $dataRow) {
            $this->clientes[] = $dataRow;
        }
    }

    public function all(): array
    {
        return $this->clientes;
    }

    public function findById(int $clienteId): ?Cliente
    {
        $rows = [];
        foreach ($this->clientes as $dataRow) {
            if ($dataRow->getId() === $clienteId) {
                return $dataRow;
            }
        }

        return new Cliente;
    }

    public function findByName(string $clienteFirstName): ?array
    {
        $rows = [];
        foreach ($this->clientes as $dataRow) {
            if ($dataRow->getFirstName() == $clienteFirstName) {
                $rows[] = $dataRow;
            }
        }
        return $rows;
    }

    public function remove(int $clienteId)
    {
        $rows = [];
        foreach ($this->clientes as $dataRow) {
            if ($dataRow->getId() === $clienteId) {
                $rows[] = $dataRow;
                unset($this->clientes[array_search($dataRow, $this->clientes, true)]);
            }
        }
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
