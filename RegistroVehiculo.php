<?php

abstract class RegistroVehiculo
{
    private string $patente;

    public function __construct(string $patente)
    {
        $this->patente = $patente;
    }

    /* Getters */

    public function getPatente(): string
    {
        return $this->patente;
    }

    /* Setters */

    public function setPatente(string $patente): void
    {
        $this->patente = $patente;
    }

    /* Métodos */
    public function calcularPeaje(): float
    {
        return 20; // Valor por defecto, puede ser sobreescrito en las subclases
    }

    /* toString() */

    public function __toString(): string
    {
        return "Patente: " . $this->getPatente();
    }
}
