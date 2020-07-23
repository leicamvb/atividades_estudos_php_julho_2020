<?php

namespace Source\Interfaces;

/**
 * Declara a interface 'iMetMagic'
 * Para ser implementadas com os métodos mágicos para
 * evitar métodos inexistentes
 */
interface iMetMagic
{
    public function __set($name, $value);
    public function __get($name);
    public function getError();
}
