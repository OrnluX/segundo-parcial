<?php

class CabinaPeaje
{
    private array $recibos;
    private array $registros;

    public function __construct()
    {
        $this->recibos   = [];
        $this->registros = [];
    }

    /*Getters & Setters*/

    public function getRegistros(): array
    {
        return $this->registros;
    }

    public function setRegistros(array $registros): void
    {
        $this->registros = $registros;
    }

    public function getRecibos(): array
    {
        return $this->recibos;
    }

    public function setRecibos(array $recibos): void
    {
        $this->recibos = $recibos;
    }

    /* Métodos */

    /** Agrega un registro de vehículo a la colección. */
    public function agregarRegistro(RegistroVehiculo $registro): bool
    {
        $this->registros[] = $registro;
        return true;
    }

    /** Emite un recibo, lo guarda y lo devuelve. */
    public function emitirRecibo(int $numero, DateTime $fechaHora, RegistroVehiculo $vehiculo): Recibo
    {
        $valor  = $vehiculo->calcularPeaje();
        $recibo = new Recibo($numero, $valor, $fechaHora, $vehiculo);
        $this->recibos[] = $recibo;
        return $recibo;
    }


    /** Devuelve el total recaudado en la cabina de peaje en determinada fecha */
    public function totalRecaudado(DateTime $fecha): float
    {
        $total = 0.0;
        $fechaStr = $fecha->format('Y-m-d');

        foreach ($this->getRecibos() as $recibo) {
            if ($recibo->getFechaHora()->format('Y-m-d') === $fechaStr) {
                $total += $recibo->getValor();
            }
        }

        return $total;
    }

    /** Devuelve un string con todos los recibos */
    public function listarRecibos(): string
    {
        $salida = "Recibos emitidos:\n";
        foreach ($this->getRecibos() as $recibo) {
            $salida .= $recibo . "\n";
        }
        return $salida;
    }
    public function cobrarPeaje(string $unTipoRegistroVehiculo, array $info): Recibo
    {
        $vehiculo = null;

        switch ($unTipoRegistroVehiculo) {
            case 'Camion':
                $vehiculo = new Camion(
                    $info['patente'],
                    $info['peso'],
                    $info['ejes']
                );
                break;

            case 'TransporteEscolar':
                $vehiculo = new TransporteEscolar(
                    $info['patente'],
                    $info['capacidad']
                );
                break;

            case 'VehiculoParticular':
                $vehiculo = new VehiculoParticular(
                    $info['patente']
                );
                break;

            default:
                throw new InvalidArgumentException("Tipo de vehículo no reconocido: $unTipoRegistroVehiculo");
        }

        $this->agregarRegistro($vehiculo);

        $numero = count($this->getRecibos()) + 1;
        $fecha = new DateTime();

        return $this->emitirRecibo($numero, $fecha, $vehiculo);
    }

    public function reciboMayorMonto(DateTime $fecha): ?Recibo
    {
        $mayorRecibo = null;
        $fechaStr = $fecha->format('Y-m-d');

        foreach ($this->getRecibos() as $recibo) {
            $reciboFechaStr = $recibo->getFechaHora()->format('Y-m-d');

            if ($reciboFechaStr === $fechaStr) {
                if ($mayorRecibo === null || $recibo->getValor() > $mayorRecibo->getValor()) {
                    $mayorRecibo = $recibo;
                }
            }
        }

        return $mayorRecibo;
    }

    public function recaudacionXTipoVehiculo(DateTime $fecha, string $tipoRegistroVehiculo): float
    {
        $total = 0;
        $fechaStr = $fecha->format('Y-m-d');

        foreach ($this->getRecibos() as $recibo) {
            $reciboFechaStr = $recibo->getFechaHora()->format('Y-m-d');
            $vehiculo = $recibo->getVehiculo();

            if ($reciboFechaStr === $fechaStr && get_class($vehiculo) === $tipoRegistroVehiculo) {
                $total += $recibo->getValor();
            }
        }

        return $total;
    }

    /* toString */

    public function __toString(): string
    {
        $totalRegistros = count($this->getRegistros());
        $totalRecibos   = count($this->getRecibos());

        return  "Cabina de Peaje\n" .
            "Registros de vehículos: $totalRegistros\n" .
            "Recibos emitidos:      $totalRecibos\n";
    }
}
