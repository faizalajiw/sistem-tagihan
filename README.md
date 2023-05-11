# Cara Install
1. composer install
2. ketik "cp .env.example .env" 
3. buat database di phpmyadmin 
4. koneksikan database dgn masukan nama database di file .env
5. php artisan key:generate
6. php artisan migrate --seed
7. php artisan serve untuk menjalankan project

# Website Si-Payment IDI Dibuat Dengan : 
- Framework Laravel 8
- Template AdminLTE-3
- Yajra Laravel DataTable Serverside
- Sweetalert 2 
- Laravel Fortify (autentikasi)
- Spatie Laravel Role-Permission (role & permission)
- Laravel DOMPDF (pdf)

# PACKAGE
- Yajra Laravel DataTable Serverside 
- Laravel Fortify (autentiksai)
- Spatie Laravel Role-Permission
- Laravel DOMPDF (pdf)

# Login 

- ADMIN
username : admin123
password : password

- PETUGAS
username : elaina123
password : password

- Dokter
username : dokterindonesia
password : password

# PASSWORD DEFAULT NEW ACCOUNT : idibrebes

# ROLE USER
- admin
- petugas
- dokter

# AUTENTIKASI
Password default dari dokter , petugas , admin yang ditambahkan 
adalah : idi2023 (jika belum di ubah) / (jika bukan ditambahkan dari database seeder)


# FEATURES 
1.ADMIN
(CRUD AJAX NO RELOAD)
- CRUD Dokter
- CRUD Spesialis
- CRUD Petugas
- CRUD Tahun & Nominal Tagihan
- CRUD Admin
- CRUD Role
- CRUD Permission
(CRUD AJAX NO RELOAD)

- Membuat Tagihan Pembayaran
- History Pembayaran Tagihan
- Lihat Status Pembayaran Tagihan
- PRINT Pdf History Pembayaran per-range tanggal
- PRINT Pdf History Pembayaran Tagihan Per Dokter
- Setting (User Role & Permission) 

2.PETUGAS
- Read Dokter
- Read Spesialis
- Read Tahun & Nominal Tagihan
- Read Pembayaran Tagihan
- Membuat Pembayaran Tagihan
- History Pembayaran Tagihan
- Lihat Status pembayaran Tagihan
- PRINT Pdf History Pembayaran per-range tanggal
- PRINT Pdf History Pembayaran Tagihan per Dokter

3.DOKTER
- History Pembayaran Tagihan
- History Pembayaran Tagihan Per-Tahun
- Lihat Status Pembayaran Tagihan
- PRINT Pdf Laporan Pembayaran Tagihan Per-Tahun
