<?php

require_once('./trait/ReadEnv.php');

class Client
{
    use ReadEnv;

    private array $env;

    public function __construct()
    {
        $this->env = $this->read();
    }

    public function fetchOne($to)
    {
        $fetchOneEndpoint = $this->env['API_FETCH_ONE_ENDPOINT'];
        $apiKey = $this->env['API_KEY'];
        $baseCurrency = $this->env['BASE_CURRENCY'];
        $curl = curl_init();

        curl_setopt_array($curl, [
        CURLOPT_URL => "$fetchOneEndpoint?from=$baseCurrency&to=$to&api_key=$apiKey",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new Exception("cURL Error #:" . $err);
        }
        
        return json_decode($response, true);
    }
}