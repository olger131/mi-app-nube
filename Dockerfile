FROM php:8.1-apache
# Instalar extensiones para que PHP hable con MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Habilitar rutas amigables
RUN a2enmod rewrite
# Copiar tu código
COPY . /var/www/html/
# Dar permisos
RUN chown -R www-data:www-data /var/www/html
