# Initial Run Commands for Laravel Project

Dokumentasi ini berisi perintah yang dijalankan saat pertama kali men-setup atau melakukan deployment aplikasi Laravel.

## 📌 Langkah-langkah

Jalankan perintah berikut secara berurutan:

```bash
# Membuat symbolic link untuk storage (agar bisa diakses public)
php artisan storage:link

echo "Initial Run optimize"
php artisan optimize

echo "Initial Run migrate"
php artisan migrate --force

echo "Initial Run db:seed"
php artisan db:seed --force
# Jika menggunakan Laravel Passport, jalankan juga:
# php artisan passport:install --force

echo "Initial Run key:generate"
php artisan key:generate

echo "Initial Run route clear"
php artisan route:clear

echo "Initial Run config clear"
php artisan config:clear

echo "Initial Run cache clear"
php artisan cache:clear

echo "Initial Run route cache"
php artisan route:cache

echo "Initial Run config cache"
php artisan config:cache

echo "Initial Run view clear"
php artisan view:clear

echo "Initial Run view cache"
php artisan view:cache
