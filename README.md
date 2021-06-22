Daftar Login (username:password)
manufacturer = automobile@navi.com:navi

Admin Page: /admin

Program yang diperlukan:
1. MySQL untuk database. Versi: 15.1 (versi kemungkinan tidak terlalu berpengaruh)
2. PHP. Versi >= 8.0
3. NodeJS
4. Yarn NodeJS package manager
5. Composer PHP Package manager

Backend + Database
1. Clone backend <code>git clone https://github.com/suwidhi/bdl-backend </code> lalu masuk ke direktori tadi <code> cd bdl-backend </code>
2. Import data dari file sql yang ada di dalam bdl-frontend: <code>msyql -u [username] -p < dataset.sql </code> lalu input password mysql
3. Lakukan update untuk semua file yang diperlukan <code>composer update</code>
4. Ubah konfigurasi dengan edit file .env dan mengubah tanda tanya pada DB_USERNAME=? dan DB_PASSWORD=? sesuai dengan user dan password dari msyql yang ada pada komputer
5. Kemudian mulai server <code>php artisan serve</code>

Frontend + Database
1. Clone repository frontend: <code> git clone https://github.com/suwidhi/bdl-frontend </code> lalu masuk ke direktori tadi <code> cd bdl-frontend </code>
3. Lakukan update: <code>yarn upgrade</code>
4. Jalankan debug server: <code>yarn start</code>
