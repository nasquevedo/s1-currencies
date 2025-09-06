<?php
/**
 * exec file
 * 
 * Archivo que ejecuta el comando para obtener el valor de la moneda con respecto a una moneda base (USA)
 * 
 * @author <Santiago Quevedo> qesantiago@gmail.com
 */
require_once("./command/Currencies.php");

if (!isset($argv[1])) {
    die("Debe enviar una moneda. ejemplo (COP, ARS, EUR) \n");
}

if (!isset($argv[2])) {
    die("Debe enviar un monto. \n");
}

$currency = $argv[1];
$amount = $argv[2];

$currenciesCommand = new CurrenciesCommand($argv[1], (int)$argv[2]); // instancia de la clase CurrenciesCommand
$currenciesCommand->execute(); // Se ejecuta el comando



