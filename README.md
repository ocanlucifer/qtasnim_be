# qtasnim_be

backend using laravel

a. tech spec:

    - Framework : laravel versi 10.15.0
    - package yang di gunakan hanya package bawaan laravel yang include ketika install.
    - php version: PHP 8.1.9 (cli) (built: Aug  4 2022 15:12:55) (NTS)
    - Database: Mysql.
    - PosmanColection ada di root folder dengan nama "Chandra I P - QtasnimTestBackend.postman_collection.json".

b. Cara Setup di local Environment:

    - clone repository ini.
    - jika sudah ter download, masuk ke folder project nya.
    - lalu buka terminal atau command prompt dan jalankan perintah "Composer Install" dan tunggu hingga proses selesai.
    - jalankan perintah "Composer update" dan tunggu hingga proses selesai.
    - lalu copy file /.env.example dan rename menjadi /.env
    - setting database defaultnya seperti ini, silahkan di sesuiakan:
    	DB_CONNECTION=mysql
    	DB_HOST=127.0.0.1
    	DB_PORT=3306
    	DB_DATABASE=codingtestQtasnim
    	DB_USERNAME=root
    	DB_PASSWORD=
    - jika setting database telah selesai, maka kita pergi lagi ke terminal.
    - lalu jalankan perintah "php artisan migrate" untuk menjalankan migrasi database (jika muncul  WARN  The database 'codingtestQtasnim' does not exist on the 'mysql' connection.  Would you like to create it? (yes/no) [no]) ketik "yes" lalu enter, maka laravel akan membuat databasenya sendiri dan migrasi pun akan di jalankan.
    - lalu jalankan perintah "php artisan db:seed" untuk menjalankan seeder.
    - jika semua telah selesai saatnya menjalankan perintah "php artisan serve --host 0.0.0.0 --port 1313" di terminal.
    - lalu coba test menggunakan Postman, jangan lupa import dulu postmancolection nya.
