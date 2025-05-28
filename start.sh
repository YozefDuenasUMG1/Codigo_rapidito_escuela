#!/bin/bash

# Asignar permisos a las carpetas necesarias
chmod -R 775 storage bootstrap/cache

# Instalar dependencias
composer install --no-interaction --prefer-dist --optimize-autoloader
npm install

# Copiar .env si no existe
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Limpiar y cachear configuración
php artisan config:clear
php artisan key:generate --force
php artisan config:cache

# Ejecutar migraciones y seeders
php artisan migrate --force
php artisan db:seed --force

# Build de assets
npm run build

# Iniciar el servidor Laravel
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
