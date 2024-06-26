# Usar una imagen base de PHP con soporte para Laravel
FROM php:8.2-fpm

# Instalar dependencias del sistema y extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_pgsql pgsql pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear el directorio de la aplicación
WORKDIR /var/www

# Copiar archivos de la aplicación
COPY . /var/www

# Instalar dependencias de PHP
RUN composer install

# Dar permisos al directorio de almacenamiento y caché
RUN chown -R www-data:www-data /var/www
RUN chmod 755 /var/www

# Exponer el puerto 9000 y definir el comando de inicio
EXPOSE 9000
CMD ["php-fpm"]
