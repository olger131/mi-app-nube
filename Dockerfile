FROM php:8.1-apache

# 1. Instalar extensiones de MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 2. Habilitar modo de reescritura
RUN a2enmod rewrite

# 3. Configurar Apache para usar la variable de puerto de Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 4. Copiar tus archivos
COPY . /var/www/html/

# 5. Permisos
RUN chown -R www-data:www-data /var/www/html
