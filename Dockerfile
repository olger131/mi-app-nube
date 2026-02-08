FROM php:8.1-apache
# Instalar extensiones para que PHP hable con MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Habilitar rutas amigables
RUN a2enmod rewrite
# Copiar tu código
COPY . /var/www/html/
# Dar permisos
RUN chown -R www-data:www-data /var/www/html

# ESTA LÍNEA ES LA QUE ACTIVA EL LINK PÚBLICO:
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

