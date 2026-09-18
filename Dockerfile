# Usar la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar la aplicación al directorio raíz de Apache
COPY ./app/ /var/www/html/

# Exponer el puerto 80
EXPOSE 80