<?php

class Recibo
{
    private int $numero;
    private float $valor;
    private DateTime $fechaHora;
    private RegistroVehiculo $vehiculo;


    public function __construct(int $numero, float $valor, DateTime $fechaHora, RegistroVehiculo $vehiculo)
    {
        $this->numero     = $numero;
        $this->valor      = $valor;
        $this->fechaHora  = $fechaHora;
        $this->vehiculo   = $vehiculo;
    }

    /* Getters */

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getFechaHora(): DateTime
    {
        return $this->fechaHora;
    }

    public function getVehiculo(): RegistroVehiculo
    {
        return $this->vehiculo;
    }

    /* Setters */

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function setFechaHora(DateTime $fechaHora): void
    {
        $this->fechaHora = $fechaHora;
    }

    public function setVehiculo(RegistroVehiculo $vehiculo): void
    {
        $this->vehiculo = $vehiculo;
    }

    /* toString */

    public function __toString(): string
    {
        return "Recibo N° " . $this->getNumero() .
            " | Valor: $" . number_format($this->getValor(), 2) .
            " | Fecha: " . $this->getFechaHora()->format('Y-m-d H:i:s') .
            " | Vehículo: " . $this->getVehiculo();
    }
}
