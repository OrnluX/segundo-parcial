<?php

class Camion extends RegistroVehiculo
{
    private float $peso;  // en toneladas
    private int $ejes;

    public function __construct(string $patente, float $peso, int $ejes)
    {
        parent::__construct($patente);
        $this->peso = $peso;
        $this->ejes = $ejes;
    }

    /* Getters */

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getEjes(): int
    {
        return $this->ejes;
    }

    /* Setters */

    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    public function setEjes(int $ejes): void
    {
        $this->ejes = $ejes;
    }

    /* Metodos */
    public function calcularPeaje(): float
    {
        $base = 20;
        $adicionalEjes = 100 * $this->getEjes();
        $adicionalPeso = 15 * $this->getPeso();

        $subtotal = $base + $adicionalEjes + $adicionalPeso;

        $impuesto = ($this->getPeso() < 5)
            ? $subtotal * 0.02
            : $subtotal * 0.05;

        return $subtotal + $impuesto;
    }

    /* toString */

    public function __toString(): string
    {
        return "Camión | " .
            parent::__toString() .
            " | Peso: " . $this->getPeso() . " t" .
            " | Ejes: " . $this->getEjes() .
            " | Peaje: $" . number_format($this->calcularPeaje(), 2);
    }
}
