## 📊 Aplikasi Dashboard Penjualan
Aplikasi ini merupakan sistem dashboard berbasis Laravel yang menampilkan data penjualan produk, produk terlaris per kategori, dan grafik tren penjualan untuk membantu analisis performa penjualan.

🔧 Fitur Utama
### 📦 Manajemen Data Produk & Penjualan
Menyimpan data produk, kategori, dan transaksi penjualan dalam file JSON (produk.txt, kategori.txt, penjualan.txt).

### 📈 Dashboard Ringkasan
Menampilkan:

Total produk terjual bulan ini

Produk terlaris per kategori

Grafik penjualan produk berdasarkan bulan yang dipilih

Grafik total penjualan selama 6 bulan terakhir (1 bar = 1 bulan)

### 🥇 Status Penjualan Produk
Klasifikasi status performa penjualan berdasarkan total nilai penjualan:

≥ 100 juta: Tinggi

50–100 juta: Sedang

20–50 juta: Cukup

10–20 juta: Rendah

< 10 juta: Sangat Rendah

🔍 DataTable Interaktif
Semua tabel menggunakan DataTable dengan fitur pencarian dan sortir otomatis.

### 📅 Filter Penjualan Bulanan
Tersedia input bulan untuk menyaring grafik produk terlaris berdasarkan bulan tertentu.

### 🗂️ Struktur File Data
Semua data disimpan dalam direktori storage/data/:

produk.txt → Data produk (nama_produk, nama_kategori, harga)

kategori.txt → Data kategori produk

penjualan.txt → Data transaksi penjualan (tanggal_transaksi, nama_produk, item_terjual, total_penjualan)

### 💡 Cara Menjalankan
Pastikan file data sudah tersedia di storage/data/.

Jalankan Laravel:

bash
Copy
Edit
php artisan serve
Akses aplikasi melalui browser: http://localhost:8000

### 📦 Tools yang Digunakan
Laravel 10+

Blade Template

Bootstrap 4 (untuk tampilan)

Chart.js (untuk visualisasi data)

jQuery DataTables

📌 Catatan
Data tidak berasal dari database, tapi dari file JSON.

Proses perhitungan dilakukan dalam controller, seperti agregasi total penjualan, pemeringkatan produk, dan pembentukan dataset untuk chart.
