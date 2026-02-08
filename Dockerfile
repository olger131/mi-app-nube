FROM php:8.1-apache

# Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copiar tus archivos al contenedor
COPY . /var/www/html/

# Dar permisos correctos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 (estándar de Apache)
EXPOSE 80
