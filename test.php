<?php

include_once 'RegistroVehiculo.php';
include_once 'Camion.php';
include_once 'TransporteEscolar.php';
include_once 'VehiculoParticular.php';
include_once 'Recibo.php';
include_once 'CabinaPeaje.php';

echo "===== TEST PEAJES =====\n";

//Crear una cabina
$cabina = new CabinaPeaje();

// Crear 3 vehículos
$camionScania = new Camion("ABC123", 7.5, 4); // 7.5 toneladas, 4 ejes
$traficEscolar = new TransporteEscolar("DEF456", 12); // 12 niños
$toyotaCorolla = new VehiculoParticular("GHI789");

//Mostrar peajes individuales
echo "Scania (Camión) debe pagar: $" . number_format($camionScania->calcularPeaje(), 2) . "\n";
echo "Trafic (Escolar) debe pagar: $" . number_format($traficEscolar->calcularPeaje(), 2) . "\n";
echo "Toyota Corolla (Particular) debe pagar: $" . number_format($toyotaCorolla->calcularPeaje(), 2) . "\n";

echo "\n===== COBRO DE PEAJES =====\n";

// Crear fecha fija para las pruebas
$fechaFija = DateTime::createFromFormat('d/m/Y', '15/06/2024');

// Emitir recibos con fecha fija usando cobrarPeaje
$recibo1 = $cabina->emitirRecibo(1, $fechaFija, $camionScania);
$recibo2 = $cabina->emitirRecibo(2, $fechaFija, $traficEscolar);
$recibo3 = $cabina->emitirRecibo(3, $fechaFija, $toyotaCorolla);

// Mostrar los recibos emitidos
echo "Recibo Scania:\n$recibo1\n";
echo "Recibo Trafic:\n$recibo2\n";
echo "Recibo Corolla:\n$recibo3\n";

// Buscar y mostrar el recibo con mayor monto
echo "\n===== RECIBO MAYOR MONTO (15/06/2024) =====\n";
$mayor = $cabina->reciboMayorMonto($fechaFija);
echo $mayor !== null ? $mayor : "No hay recibos para esa fecha.\n";

// Mostrar la recaudación total del día
echo "\n===== TOTAL RECAUDADO (15/06/2024) =====\n";
$total = $cabina->totalRecaudado($fechaFija);
echo "Total: $" . number_format($total, 2) . "\n";
