#!/bin/bash
set -e

echo "🚀 Starting deployment tasks..."

# Run migrations
echo "Running database migrations..."
php artisan migrate --force
php artisan storage:link

# Cache config, routes, and views for performance
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment tasks completed. Starting Apache..."

# Execute the main container command (apache2-foreground)
exec "$@"
