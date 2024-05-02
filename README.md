Untuk menjalankan projek ini,langkah-langkahnya:

pertama ketik:composer install
kemudian buat database terlebih dahulu kemudian ketik:php artisan migrate
kemudian ketik perintah php artisan db:seed --class=UserSeeder  =>ini untuk membuat dummy data 
setelah itu baru jalankan php artisan serve dan juga perintah npm run dev

PROJECT INI MENGGUNAKAN PHP VERSI 8.1.10 dan Laravel versi 10
