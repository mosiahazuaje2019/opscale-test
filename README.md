## Retos Opscale

En este repositorio trabaje el reto para implementar Spatie Webhook Server asi como tambien trabaje con Nova Action con Fast Excel para importar y exportar todos los registros de usuarios.

## Instalacion o descarga del proyecto
- **[Docker] Debe tener instalado Docker en la instancia que vaya a implementar el proyecto**
- En el env-example esta una copia del archivo env que he utilizado para que el proyecto funcione.
- Estoy haciendo uso de Laravel 10 con Sail.
- Luego debe correr el siguiente comando:
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```
- En caso de que quiera levantar los servicios haciendo uso de Sail tendria que estar en la carpeta del proyecto y colocar en la terminal ./vendor/bin/sail up con esto se encienden los contenedores.
- Luego que levante los servicios debe correr un ./vendor/bin/sail artisan migrate.
- En caso de querer utilizar directamente docker entonces puede utilizar el comando docker-compose up -d y luego para hacer el migrate docker-compose exec laravel.test php artisan migrate.
