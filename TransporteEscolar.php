<?php

class TransporteEscolar extends RegistroVehiculo
{
    private int $capacidadMaxima;

    public function __construct(string $patente, int $capacidadMaxima)
    {
        parent::__construct($patente);
        $this->capacidadMaxima = $capacidadMaxima;
    }

    /* Getters */

    public function getCapacidadMaxima(): int
    {
        return $this->capacidadMaxima;
    }

    /*  Setters */

    public function setCapacidadMaxima(int $capacidadMaxima): void
    {
        $this->capacidadMaxima = $capacidadMaxima;
    }

    /* Metodos */

    public function calcularPeaje(): float
    {
        return 25 * $this->getCapacidadMaxima();
    }

    /* toString */

    public function __toString(): string
    {
        return "Transporte Escolar | " .
            parent::__toString() .
            " | Capacidad: " . $this->getCapacidadMaxima() . " niños" .
            " | Peaje: $" . number_format($this->calcularPeaje(), 2);
    }
}
