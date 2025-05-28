#!/bin/bash
# Script para iniciar el backend en Railway (producción)

# Permisos para carpetas necesarias
chmod -R 775 storage bootstrap/cache

# Instalar dependencias si es necesario (Railway suele hacerlo, pero por si acaso)
composer install --no-interaction --prefer-dist --optimize-autoloader
npm install

# Generar clave de aplicación si no existe
if [ ! -f .env ]; then
  cp .env.example .env
fi
php artisan key:generate --force

# Ejecutar migraciones y seeders
php artisan migrate --force
php artisan db:seed --force

# Build de assets para producción
npm run build

# Iniciar el servidor de Laravel en el puerto que Railway indique
php artisan serve --host=0.0.0.0 --port=${PORT:-8000} 