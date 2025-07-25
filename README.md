Laravel + SvelteKit CRUD swagger laravel API (Swagger Documented)

Ini adalah proyek aplikasi manajemen data desa berbasis Laravel (Backend) dan SvelteKit (Frontend), yang menggunakan Swagger untuk dokumentasi API.

🔧 Fitur Utama
- CRUD Data Desa (Tambah, Lihat, Edit, Hapus)
- Tampilan frontend seperti phpMyAdmin
- API terdokumentasi menggunakan Swagger UI
- Input pencarian desa
- Validasi form
- Desain responsif dan simpel

🛠️ Teknologi yang Digunakan
- Laravel 10 (REST API Backend)
- MySQL (Database)
- Swagger (API Documentation)
- SvelteKit + Bootstrap (Frontend)
- Vite (Module bundler)
- 
Running project
Backend (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve --port=8000

cd frontend
npm install
npm run dev
