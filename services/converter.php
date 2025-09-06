<?php
require_once('./client/client.php');

class Converter 
{
    private string $to;
    private int $amount;

    public function __construct($to, $amount)
    {
        $this->to = $to;
        $this->amount = $amount;
    }

    public function convert()
    {
        try {
            $client = new Client();
            $response = $client->fetchOne($this->to);
            $base = $response['base'];
            $baseCurrencyValue = round($response['result'][$this->to]);
            $convertion = $this->amount / (int)$baseCurrencyValue;
            $data = [
                "success" => true,
                "result" => [
                    "base" => $base,
                    "base_currency_value" => $baseCurrencyValue,
                    "convertion" => round($convertion)
                ]
            ];

            return $data;
        } catch (Exception $error) {
            $data = [
                "success" => false,
                "error" => $error
            ];

            return $data;
        }
    }
}