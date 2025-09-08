<?php

require_once('./trait/ReadEnv.php');

/**
 * Client Class
 * 
 * Clase cliente para realizar operaciones al api externo
 * (fastforex)
 * 
 * @access public
 * @author <Santiago Quevedo> qesantiago@gmail.com
 */
class Client
{
    use ReadEnv; // uso del trait para obtener las variables de entorno

    /**
     * @var array env almacena las variables de 
     * entorno tomadas del archivo .env 
     */
    private array $env;

    /**
     * Construct Method
     * 
     * Metodo que construye el objeto
     * Al momento de instanciar obtiene
     * las variables de entorno
     * 
     * @access public
     * @author <Santiago Quevedo> qesantiago@gmail.com
     * @return void
     */
    public function __construct()
    {
        $this->env = $this->read();
    }

    /**
     * fetchOne Method
     * 
     * Metodo que obtiene el valor de la divisa con respecto a
     * la moneda base y la moneda a consultar, unicamente valida
     * una moneda a la vez
     * 
     * @access public
     * @author <Santiago Quevedo> qesantiago@gmail.com
     * @param string $to moneda a consultar
     * @return array
     */
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
        // die($response);
        curl_close($curl);

        if (isset(json_decode($response, true)['error'])) {
            throw new Exception("cURL Error #: " . json_decode($response, true)['error'] );
        }
        
        return json_decode($response, true);
    }
}