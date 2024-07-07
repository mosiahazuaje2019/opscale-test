## Retos Opscale

En este repositorio trabaje el reto para implementar Spatie Webhook Server asi como tambien trabaje con Nova Action con Fast Excel para importar y exportar todos los registros de usuarios.

## Instalacion o descarga del proyecto
- **[Docker] Debe tener instalado Docker en la instancia que vaya a implementar el proyecto**
- Luego debe correr el siguiente comando docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs.
- En el env-example esta una copia del archivo env que he utilizado para que el proyecto funcione.
