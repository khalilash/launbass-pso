<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Kelompok 9 PSO C
Nabila Rahadatul - 5026231025
Zaskia Muazatun - 5026231021
Khalila Shafarayhani A - 5026231167

## Domain Azure
launbass-v2-pso-d8b9h7ejd6eaeudy.southeastasia-01.azurewebsites.net

## Apps Description
Launbass memberikan layanan digitalisasi dalam proses bisnis dari usaha laundry, yang memungkinkan pemilik memantau seluruh proses dari penerimaan baju sampai pengambilan baju, detail pesanan dan juga pencacatan keuangan yang ada. Aplikasi memiliki beberapa fitur unggulan seperti chat interaktif dan juga integrasi pencatatan sistem keuangan yang dilengkapi dengan informasi pekerja yang bertugas pada saat itu. Tujuan utama dari aplikasi ini adalah memberikan pengalaman digital laundry yang terintegrasi dan memuaskan melalui sistem yang mudah digunakan, efisien juga informatif bagi pemilik laundry. Latar belakang tujuan ini berdasar dari masalah umum dimana sulit mengatur jadwal pengambilan dan pengantaran baju, juga tidak adanya integrasi proses laundry dari tiap pelanggan apabila terjadi pergantian shift.

## Feature
Aplikasi laundry untuk pemilik usaha ini dirancang agar dapat membantu mengelola seluruh proses operasional, keuangan, hingga interaksi dengan pelanggan. Berikut fitur-fitur utama yang tersedia:
-   Manajemen Pesanan & Operasional
Aplikasi menyediakan fitur pencatatan pesanan lengkap dengan detail pelanggan (nama, nomor HP, alamat, dan catatan khusus). Pemilik dapat memantau status pesanan secara real-time mulai dari diterima, dicuci, dikeringkan, disetrika, hingga selesai. Selain itu, sistem mendukung penjadwalan kerja agar beban cucian bisa dibagi secara optimal, serta mempermudah pengaturan pengantaran dan penjemputan cucian.
- Komunikasi & Manajemen Pelanggan (CRM)
Fitur chatbot interaktif memudahkan pelanggan bertanya status cucian tanpa harus menghubungi langsung pemilik. Selain itu, aplikasi menyimpan data pelanggan dan riwayat transaksi, sehingga memudahkan pengelolaan hubungan jangka panjang. Fitur komplain juga tersedia agar pelanggan dapat melaporkan masalah layanan dengan cepat.
- Manajemen SDM
Untuk usaha laundry dengan beberapa karyawan, aplikasi membantu pemilik mengatur performa kerja dan menghitung gaji otomatis berdasarkan kontribusi masing-masing. Hal ini mendukung transparansi dan efisiensi dalam pengelolaan tenaga kerja.
- Manajemen Keuangan
Mencatat pemasukan dan pengeluaran harian secara otomatis.
- Informasi & Tampilan
Aplikasi menampilkan profil bisnis laundry secara jelas, meliputi alamat, jam operasional, daftar layanan, serta harga. Dengan begitu, pelanggan baru maupun lama dapat dengan mudah memahami layanan yang ditawarkan.

## Arsitektur DevOps & Infrastruktur Cloud

Proyek ini menerapkan ekosistem DevOps modern guna menjamin kualitas kode tinggi dan ketersediaan layanan (*high availability*) tanpa intervensi manual yang repetitif.

### 1. Continuous Integration (CI) via GitHub Actions
Setiap kali tim pengembang melakukan *push* atau *merge* ke branch `main`, pipeline GitHub Actions akan terpicu secara otomatis untuk melakukan validasi awal:
* Inisialisasi *environment* PHP 8.2 dan manajemen dependensi via Composer.
* Pemeriksaan keamanan berkas dan sinkronisasi *environment secrets* secara aman.

### 2. Quality Gate & Automated Testing (SonarQube & PHPUnit)
* **Automated Testing:** Pipeline mengeksekusi rangkaian *Unit Test* dan *Feature Test* menggunakan framework PHPUnit untuk memastikan tidak ada fitur lama yang rusak (*regression*) akibat kode baru.
* **Statics Code Analysis:** Kode kemudian dilempar ke **SonarQube Cloud** untuk memindai adanya *bug*, celah keamanan (*vulnerabilities*), maupun *code smell*.
* **Code Coverage:** Berdasarkan hasil pengujian akhir, proyek ini berhasil menyentuh angka **70.6% Code Coverage**, memenuhi standar kelayakan rilis.

### 3. Continuous Deployment (CD) ke Microsoft Azure
* **Azure App Service:** Kode yang telah dinyatakan lolos pengujian (*passed code quality check*) akan langsung di-deploy secara otomatis ke infrastruktur cloud Microsoft Azure App Service (berbasis Linux Environment).
* **Zero Downtime:** Membantu proses *publish* dan pembaruan fitur aplikasi berjalan secara berkelanjutan tanpa perlu melakukan konfigurasi server virtual atau web server secara manual dari awal.

### 4. Continuous Monitoring
* **Azure Monitor:** Setelah aplikasi berjalan di lingkungan produksi, performa sistem dipantau secara berkala melalui platform monitoring bawaan Azure. 
* Metrik yang diawasi mencakup total *incoming requests*, rata-rata *response time* server, data *in/out traffic*, hingga pelacakan log eror secara *real-time* untuk mempercepat proses *debugging* jika terjadi kendala pada server.

Dokumentasi detail mengenai project ini dapat diakses di: https://canva.link/qf2q7i05826pj5p
