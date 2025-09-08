<?php
require_once('./client/Client.php');

/**
 * Class Converter
 * 
 * Clase para realizar operaciones de divisas, obtiene el valor de la moneda base
 * y aplica una conversion a la moneda introducida por el usuario
 * 
 * @access public
 * @author <Santiago Quevedo> qesantiago@gmail.com>
 */
class Converter 
{
    /**
     * @var string $to moneda a validar
     */
    private string $to;

    /**
     * @var int $amount monto a convertir
     */
    private int $amount;

    /**
     * Contruct Method
     * 
     * Metodo constructor de la clase, inicializa los valores
     * 
     * @access public
     * @author <Santiago Quevedo>
     * @param string $to moneda a validar
     * @param int $amount monto a convertir
     * @return void
     */
    public function __construct($to, $amount)
    {
        $this->to = $to;
        $this->amount = $amount;
    }

    /**
     * convert method
     * 
     * Metodo convert, obtiene la informacion de la divisa y 
     * convierte el monto a la moneda base
     * 
     * @access public
     * @author <Santiago Quevedo> qesantiago@gmail.com
     * @return array
     */
    public function convert()
    {
        try {
            $client = new Client();
            $response = $client->fetchOne($this->to);
            $base = $response['base'];
            $baseCurrencyValue = round($response['result'][$this->to], 2);
            $convertion = $this->amount / (float)$baseCurrencyValue;
            $data = [
                "success" => true,
                "result" => [
                    "base" => $base,
                    "base_currency_value" => $baseCurrencyValue,
                    "convertion" => round($convertion, 2)
                ]
            ];

            return $data;
        } catch (Exception $error) {
            $data = [
                "success" => false,
                "error" => $error->getMessage()
            ];

            return $data;
        }
    }
}