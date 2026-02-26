# Use a imagem oficial PHP com Apache
FROM php:8.2-apache

# Instala extensões do PHP necessárias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia os arquivos do projeto para o servidor web
COPY . /var/www/html/

# Expor a porta 80 (HTTP)
EXPOSE 80
