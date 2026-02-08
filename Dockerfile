FROM php:8.1-apache

# 1. Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# 3. Copiar tus archivos al contenedor
COPY . /var/www/html/

# 4. Asegurar permisos correctos para evitar errores de lectura
RUN chown -R www-data:www-data /var/www/html

# 5. Configurar el puerto dinámico de Railway antes de arrancar Apache
CMD sed -i 's/80/'"$PORT"'/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && apache2-foreground
