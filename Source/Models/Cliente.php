<?php

namespace Source\Models;

class Cliente implements \Source\Interfaces\iMetMagic
{
    private ?int $id = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?string $email = null;
    private $error;

    //Getters e Setters
    public function setCliente($id, $firstName, $lastName, $email)
    {
        $this->setId($id);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);

        if (!$this->setEmail($email)) {
            $this->error = "O e-mail {$this->getEmail()} não é válido!";
            return false;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    private function setFirstName($firstName)
    {
        $this->firstName = filter_var($firstName, FILTER_SANITIZE_STRIPPED);
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    private function setLastName($lastName)
    {
        $this->lastName = filter_var($lastName, FILTER_SANITIZE_STRIPPED);
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    // Valida o e-mail do usuário em um formato válido!
    private function setEmail($email)
    {
        $this->email = filter_var($email, FILTER_SANITIZE_STRIPPED);;

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return true;
        } else {
            return false;
        }
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
