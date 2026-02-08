FROM php:8.1-apache

# 1. Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Habilitar el módulo de reescritura
RUN a2enmod rewrite

# 3. Copiar tus archivos
COPY . /var/www/html/

# 4. Asegurar permisos
RUN chown -R www-data:www-data /var/www/html

# 5. Configurar el puerto y arrancar Apache al mismo tiempo
CMD sed -i 's/80/'"$PORT"'/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf && apache2-foreground
