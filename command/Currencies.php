<?php

require_once('CommandInterface.php');
require_once('./services/Converter.php');

/**
 * CurrenciesCommand class
 * 
 * Clase que representa el comando para el cambio de divisas
 * 
 * @access public
 * @author <Santiago Quevedo> qesantiago@gmail.com
 */
class CurrenciesCommand implements CommandInterface
{
    /**
     * @var string $name nombre del comando
     */
    private string $name = "Currencies Command";

    /**
     * @var int $amount monto a convertir
     */
    private int $amount;

    /**
     * @var string $currency moneda a validar
     */
    private string $currency;

    /**
     * Construct method
     * 
     * Metodo que construye el objecto, inicializa las variables
     * principales
     * 
     * @access public
     * @author <Santiago Quevedo> qesantiago@gmail.com
     * @return void
     */
    public function __construct($currency, $amount)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * execute method
     * 
     * Metodo que ejecuta la logica del comando para devolver una
     * respuesta en pantalla
     * 
     * @access public
     * @author <Santigo Quevedo> qesantiago@gmail.com
     * @return void
     */
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

        echo "Error al intentar convertir el monto " . $data['error']. ".\n";
        exit();
    }
}