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

class Produtos implements \Source\Interfaces\iMetMagic
{
    private $produtos = [];

    public function lastId(): int
    {
        (int) $lastId = 0;

        foreach ($this->produtos as $dataRow) {
            if ($dataRow->getId() > $lastId) {
                $lastId = $dataRow->getId();
            }
        }
        return (int) $lastId;
    }

    public function add(Produto ...$params): void
    {
        $args = func_get_args();

        foreach ($args as $dataRow) {
            $this->produtos[] = $dataRow;
        }
    }

    public function all(): array
    {
        return $this->produtos;
    }

    public function findById(int $produtoId): ?Produto
    {
        $rows = [];
        foreach ($this->produtos as $dataRow) {
            if ($dataRow->getId() === $produtoId) {
                return $dataRow;
            }
        }

        return new Produto;
    }

    public function findByName(string $produtoDescricao): ?array
    {
        $rows = [];
        foreach ($this->produtos as $dataRow) {
            if ($dataRow->getDescricao() == $produtoDescricao) {
                $rows[] = $dataRow;
            }
        }
        return $rows;
    }

    public function remove(int $produtoId)
    {
        $rows = [];
        foreach ($this->produtos as $dataRow) {
            if ($dataRow->getId() === $produtoId) {
                $rows[] = $dataRow;
                unset($this->produtos[array_search($dataRow, $this->produtos, true)]);
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
