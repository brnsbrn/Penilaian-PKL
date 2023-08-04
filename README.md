# Website Penilaian Siswa PKL KCU Bankaltimtara Samarinda

Website ini merupakan sistem manajemen data mengenai sistem penilaian terhadap seluruh siswa yang melakukan Praktek Kerja Lapangan (PKL) di Kantor Cabang
Utama Bankaltimtara Samarinda. Website ini dapat digunakan oleh Karyawan Bankaltimtara Pusat selaku penilai terhadap siswa PKL yang bersangkutan serta instansi asal siswa PKL guna menginput data siswa mereka serta melihat hasil akhir penilaian terhadap siswa mereka.

![image](https://github.com/brnsbrn/Penilaian-PKL/assets/112292625/1f411f42-d102-4f04-8d18-97840e6283ad)

![image](https://github.com/brnsbrn/Penilaian-PKL/assets/112292625/2cf5521e-9cb6-4c83-9cd1-8aae79c5c2a1)

## Tutorial Menjalankan Website
Pastikan anda telah menginstall Composer dan Laravel di device anda.
1. Lakukan clone terhadap repository ini seperti dibawah ini.
```bash
git clone https://github.com/brnsbrn/Penilaian-PKL.git
```
2. Akses Folder tempat anda menyimpan hasil clone file project ini.
```bash
cd nama_folder
```
3. Kemudian install seluruh dependency menggunakan composer.
```bash
composer install
```
4. Masukkan generate key untuk mendapatkan access key.
```bash
php artisan key:generate
```
5. Ubah file .envexample menjadi .env dan hubungkan konfigurasi database anda di sana.
6. Lakukan migrasi seluruh tabel menuju database anda
```bash
php artisan migrate
```
7. Lakukan serve untuk menjalankan project di server localhost anda.
```bash
php artisan serve
```

