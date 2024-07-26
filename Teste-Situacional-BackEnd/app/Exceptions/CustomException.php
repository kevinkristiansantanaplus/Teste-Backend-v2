<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $statusCode;

    // Cria o construtor da classe derivada
    public function __construct(string $message, int $statusCode)
    {

        $this->statusCode = $statusCode;
        // Instancia a classe pai
        parent::__construct($message);

    }

    // Método para facilitar a captura do status code da exceção
    public function getStatusCode()
    {

        return $this->statusCode;

    }

}