<?php

/**
 * ReadEnv Trait
 * 
 * Trait para leer el archivo .env y obtener el valor de las variables de entorno
 * diseñado como un trait para uso general sin depender de herencia
 */
Trait ReadEnv {

    /**
     * Read method
     * 
     * Metodo para leer el .env y retornar las variables como su un array para 
     * su uso
     * 
     * @author <Santiago Quevedo> qesantiago@gmail.com
     * @return array
     */
    function read()
    {
        return parse_ini_file('./.env');
    }
}