FROM php:8.2-apache
# Instalamos la extensión necesaria para MySQL
RUN docker-php-ext-install mysqli
# Copiamos tu index.php dentro del contenedor
COPY . /var/www/html/