<?php

class VehiculoParticular extends RegistroVehiculo
{

    public function __construct(string $patente)
    {
        parent::__construct($patente);
    }

    /* toString*/

    public function __toString(): string
    {
        return "Vehículo Particular | " .
            parent::__toString() .
            " | Peaje: $" . number_format($this->calcularPeaje(), 2);
    }
}
