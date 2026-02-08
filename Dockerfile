FROM php:8.1-apache

# Instalar extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar el módulo de reescritura
RUN a2enmod rewrite

# Copiar tus archivos al servidor
COPY . /var/www/html/

# Configurar el puerto que Railway espera
sed -i 's/Listen 80/Listen ${PORT}/g' /etc/apache2/ports.conf
sed -i 's/:80/:${PORT}/g' /etc/apache2/sites-available/000-default.conf

# Permisos para que PHP pueda escribir si es necesario
RUN chown -R www-data:www-data /var/www/html
