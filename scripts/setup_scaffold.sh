#!/usr/bin/env bash
set -e
ROOT="$(pwd)"
mkdir -p apps overlays

# Create Laravel app if missing
if [ ! -d "apps/api" ]; then
  echo ">> Creating Laravel skeleton (composer create-project)"
  composer create-project laravel/laravel apps/api
fi

pushd apps/api >/dev/null
composer require laravel/sanctum spatie/laravel-permission
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" --force || true
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config" --force || true
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations" --force || true
popd >/dev/null

# Next.js apps
if [ ! -d "apps/b2c" ]; then
  echo ">> Creating Next.js B2C"
  yes "" | npx create-next-app@latest apps/b2c --typescript --eslint --tailwind --app --src-dir --import-alias "@/*"
fi
if [ ! -d "apps/b2b" ]; then
  echo ">> Creating Next.js B2B"
  yes "" | npx create-next-app@latest apps/b2b --typescript --eslint --tailwind --app --src-dir --import-alias "@/*"
fi

# Copy overlays
rsync -a overlays/api/ apps/api/
rsync -a overlays/b2c/ apps/b2c/
rsync -a overlays/b2b/ apps/b2b/

echo "✅ Scaffold applied. Configure env files in env/ and follow README."
