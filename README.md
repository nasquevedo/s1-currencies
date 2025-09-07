# S1 Currencies

Comando para obtener el valor de la moneda base (USD) para una moneda dada (COP, ARS, EUR), diseñado en PHP 7.4 sin la ayuda de ningun framework o libreria externa, se usan conceptos modernos como SOLID principles, clean code, un poco del patron de diseño command y PHPDocs para la documentacion del mismo dentro del código.

Se utiliza el api fastforex en su version gratuita, para este comando se usa el siguiente endpoint para obtener el valor de la moneda base de una unica moneda:
- https://api.fastforex.io/fetch-one?from={moneda base}&to={moneda a convertir}&api_key={API KEY}

La estructura del comando:
- php exec.php {moneda} {monto}

Lo atributos son obligatorios y se mostrara un mensaje en caso de no enviarlos.

## Requerimientos
- PHP 7.4
- PHP CLI 7.4
- Git

## Configuracion
Para configurar el proyecto localmente se deben seguir unos pocos pasos:

Primeramente, clonar el repositorio:
```sh
git clone https://github.com/nasquevedo/s1-currencies.git
```

Seguido de esto moverse a la carpeta creada: ``` cd s1-currencies ```

Una vez estando en el proyecto copiar el contenido del archivo .env.local a .env para crearlo: ```cp .env.local .env ```

Incluir el api key enviado al correo en el archivo .env.

Por ultimo ejecutar el comando usando PHP CLI:
```sh
php exec.php COP 100000
```
