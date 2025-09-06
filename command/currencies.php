<?php

require_once('command.php');
require_once('./services/converter.php');

class CurrenciesCommand implements command
{
    private string $name = "Currencies Command";
    private int $amount;
    private string $currency;

    public function __construct($currency, $amount)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function execute()
    {
        echo "$this->name  \n";
        
        $converter = new Converter($this->currency, $this->amount);
        $data = $converter->convert();
        

        if ($data['success'])   {
            echo "MONEDA BASE: " . $data['result']['base'] . "\n";
            echo "VALOR DE LA MONEDA BASE: " . $data['result']['base_currency_value'] . " \n";
            echo "----- CONVERSION ----- \n";
            echo $this->currency . ": $this->amount \n";
            echo $data['result']['base'] . ": " . $data['result']['convertion'] . " \n";
            exit();
        }

        echo "Error al intentar convertir el monto " . $data['error'];
        exit();
    }
}