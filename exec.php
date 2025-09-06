<?php

require_once("./command/currencies.php");



if (!isset($argv[1])) {
    die("Debe enviar una moneda. ejemplo (COP, ARS, EUR) \n");
}

if (!isset($argv[2])) {
    die("Debe enviar un monto. \n");
}

$currency = $argv[1];
$amount = $argv[2];

$currenciesCommand = new CurrenciesCommand($argv[1], (int)$argv[2]);
$currenciesCommand->execute();



