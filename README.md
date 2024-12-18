# Sistem Informasi Prestasi Mahasiswa

## Deskripsi Proyek

Sistem Informasi Prestasi Mahasiswa ini dibuat untuk memudahkan pengelolaan data prestasi non-akademik mahasiswa, yang mencakup pengajuan kompetisi, validasi, dan pencatatan prestasi. Proyek ini mengimplementasikan konsep **Model-View-Controller (MVC)** serta prinsip **Pemrograman Berorientasi Objek (OOP)**, dengan penggunaan **SQL Server** sebagai database dan implementasi **Stored Procedure**, **View**, dan **Trigger**.

### Fitur Utama:
- **Pengajuan Kompetisi**: Mahasiswa dapat mengajukan kompetisi yang diikuti dan menunggu validasi dari admin.
- **Validasi Prestasi**: Admin memvalidasi kompetisi yang diajukan dan memasukkan data prestasi non-akademik mahasiswa.
- **Dashboard**: Halaman utama untuk melihat status kompetisi dan prestasi mahasiswa.
- **Manajemen Mahasiswa dan Dosen**: Admin dapat menambah, mengedit, dan menghapus data mahasiswa serta dosen yang terlibat dalam kompetisi.

---

## Anggota Kelompok

### Kelompok 4:
- **Aditya Yuhanda Putra (2341760050 / 01)** - Backend Developer
- **Aldo Khrisna Wijaya (2341760091 / 03)** - Frontend Developer
- **Faiza Anathasya Eka Falen (2341760105 / 12)** - Backend Developer
- **Kanaya Abdielaramadhani Hidayat (2341760118 / 15)** - Backend Developer
- **Karina Ika Indasa (2341760042 / 16)** - Backend Developer

---

## Teknologi yang Digunakan

- **Bahasa Pemrograman**: PHP
- **Framework**: MVC Pattern
- **Database**: SQL Server
- **Fitur Database**:
  - **Stored Procedure**: Untuk menangani logika bisnis yang rumit dan operasi database secara efisien.
  - **View**: Digunakan untuk menampilkan data yang diformat dengan cara yang lebih baik.
  - **Trigger**: Digunakan untuk melakukan aksi otomatis pada database ketika ada perubahan data.

---

## Penjelasan Proyek

### 1. **Model-View-Controller (MVC)**:
- **Model**: Berfungsi untuk menangani data, pengambilan data dari database, dan logika bisnis. Contohnya adalah `AdminModel.php`, yang mengelola data mahasiswa dan kompetisi.
- **View**: Menyediakan antarmuka untuk pengguna. Contoh: `addMahasiswa.php` adalah halaman form untuk menambah data mahasiswa.
- **Controller**: Menghubungkan antara model dan view. Misalnya, `AdminController.php` bertanggung jawab untuk menangani alur logika saat admin mengelola mahasiswa dan kompetisi.

### 2. **Pemrograman Berorientasi Objek (OOP)**:
- Kode menggunakan konsep OOP untuk memisahkan setiap bagian logika bisnis (Model), antarmuka pengguna (View), dan kontrol alur aplikasi (Controller).
- Contoh: `AdminController` memiliki metode seperti `addMahasiswa()` yang menangani alur pengolahan data mahasiswa.

### 3. **Database (SQL Server)**:
- **Stored Procedure**: Digunakan untuk melakukan operasi database secara efisien. Contoh:
  - `sp_AddMahasiswaByUsername`: Menambahkan data mahasiswa berdasarkan username.
  - `sp_DeleteMahasiswa`: Menghapus data mahasiswa dari database.
  
- **View**: Digunakan untuk menyajikan data dalam format tertentu.
  
- **Trigger**: Untuk otomatisasi, seperti yang digunakan untuk mencatat log perubahan data.

