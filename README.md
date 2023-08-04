# Website Penilaian Siswa PKL KCU Bankaltimtara Samarinda

Website ini merupakan sistem manajemen data mengenai sistem penilaian terhadap seluruh siswa yang melakukan Praktek Kerja Lapangan (PKL) di Kantor Cabang
Utama Bankaltimtara Samarinda. Website ini dapat digunakan oleh Karyawan Bankaltimtara Pusat selaku penilai terhadap siswa PKL yang bersangkutan serta instansi asal siswa PKL guna menginput data siswa mereka serta melihat hasil akhir penilaian terhadap siswa mereka.

![image](https://github.com/brnsbrn/Penilaian-PKL/assets/112292625/1f411f42-d102-4f04-8d18-97840e6283ad)

![image](https://github.com/brnsbrn/Penilaian-PKL/assets/112292625/2cf5521e-9cb6-4c83-9cd1-8aae79c5c2a1)


Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Penilaian-PKL
Sistem administrasi untuk menilai kinerja siswa PKL yang ada di Bankaltimtara


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

