# Lab7Web - PHP Framework (CodeIgniter 4)

Praktikum ini mempelajari konsep dasar framework PHP CodeIgniter 4 dengan fokus pada arsitektur MVC dan pembuatan aplikasi web sederhana.

# Praktikum 1 : sistem MVC

**Langkah Langkah**

**Instalasi CodeIgniter 4**

instalasi menggunakan composer :

composer create-project codeigniter4/appstarter . --no-dev

Untuk memastikan instalasi berhasil, akses http://localhost:8081/lab11_php_ci/public/ dan halaman welcome CodeIgniter 4 akan muncul.
![image](https://github.com/user-attachments/assets/d7e1ab9b-9028-4995-b4f5-3b519bddc1d2)

**Konfigurasi Dasar**

Mengaktifkan Mode Debugging :
  - Ubah file env menjadi .env
  - Set CI_ENVIRONMENT = development
![image](https://github.com/user-attachments/assets/5f37b005-d5c7-4b4f-b4e4-388dbda1d8a3)

**Implementasi MVC**
1. Routing

Menambahkan Route ke app/config/Routes.php :
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
   
3. Controller
Buat file controller menggunakan CLI : php spark make:controller page
![image](https://github.com/user-attachments/assets/b6ecb5e9-3ae2-4ee6-9647-9efbb8bb668f)

4. View dengan template
  - Template Header :
  ![image](https://github.com/user-attachments/assets/ace9fecb-d699-4fb7-913f-1fa349e79f20)
  
  - Template Footer :
  ![image](https://github.com/user-attachments/assets/5fec80f7-b957-4d92-8d3d-1d7beffbd90f)

  - View Pages (contoh about.php)
  ![image](https://github.com/user-attachments/assets/15bc7700-9894-4389-b35e-72e4ed20c507)

hasil dari view about.php :

![image](https://github.com/user-attachments/assets/4328eaf7-49fc-47ff-b9bd-e3eb28c4db66)

# Praktikum 2 : Sistem CRUD artikel

**Langkah Langkah Praktikum :**

**1. Persiapan Database**

Membuat database dan tabel untuk studi kasus data artikel.

Membuat Database

CREATE DATABASE lab_ci4;

Membuat Tabel Artikel

CREATE TABLE artikel (
    id INT(11) auto_increment,
    judul VARCHAR(200) NOT NULL,
    isi TEXT,
    gambar VARCHAR(200),
    status TINYINT(1) DEFAULT 0,
    slug VARCHAR(200),
    PRIMARY KEY(id)
);

![image](https://github.com/user-attachments/assets/52f26397-4306-45cf-95fb-5751f2d5fe64)

   
**2. Konfigurasi Database**

Konfigurasi Koneksi ke database melalui file .env 

![image](https://github.com/user-attachments/assets/021432e8-892f-497e-9e04-c1d8d9a9015d)

   
**3. Membuat Model**

Membuat file ArtikelModel dengan _php spark make:model ArtikelModel_

![image](https://github.com/user-attachments/assets/56d6b946-bf59-4adc-8dfa-8121afbe306e)
   
**4. Membuat Controller**

Membuat file artikel.php dengan _php spark make:controller Artikel_

![image](https://github.com/user-attachments/assets/bc3b3e62-a9a8-47aa-bdaa-2f574c258a12)
   
**5. Membuat View**

Membuat file index.php di directory app/views/artikel/ untuk menampilkan daftar artikel

![image](https://github.com/user-attachments/assets/dddeba96-db2c-42de-9f3e-e802a4fec3ab)

   
**6. Menambahkan Data Sample**

Menambahkan data Sampel ke database untuk testing

INSERT INTO artikel (judul, isi, slug) VALUES
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun.', 'artikel-kedua');


**7. Membuat Halaman Detail Artikel**

menambahkan method **view()** di controller artikel.php dan membuat halaman viewnya di directory app/views/artikel/detail.php

![image](https://github.com/user-attachments/assets/ab2cf275-ae11-49ee-aa50-05fc80a70654)

![image](https://github.com/user-attachments/assets/6c325a92-bb43-4df9-a5ce-06006f713bd1)


**8. Membuat Menu Admin**

membuat method halaman admin untuk operasi CRUD serta membuat halaman viewsnya di directory app/views/artikel/admin_index.php 

![image](https://github.com/user-attachments/assets/83935b84-a943-44ed-93f4-24d85ee4c64d)

![image](https://github.com/user-attachments/assets/f7cc43df-968c-49df-baf1-69162e9ca6c8)


**9. Membuat Routing**

tambahkan routing di app/config/routes.php

![image](https://github.com/user-attachments/assets/aedf7cd7-a5b2-4d08-ab8c-8ca4bcff4c3c)


**10. Implementasi CRUD**

- Menambah Data
  
  ![image](https://github.com/user-attachments/assets/3782c969-a636-4aa1-990e-05a615331415)

- Update Data
  
  ![image](https://github.com/user-attachments/assets/a48f0c4f-289a-497b-b629-9c1c290d89d4)

- Delete Data

  ![image](https://github.com/user-attachments/assets/c1ebee32-65be-4448-a082-8861891873a0)

# Praktikum 3 : View Layout dan View Cell

**Langkah Langkah :**

**1. Membuat Layout Utama**

Membuat folder layout di dalam app/Views/ dan membuat file main.php sebagai template utama aplikasi.


**2. Modifikasi View Dengan Layout**

Mengubah view yang sudah ada untuk menggunakan layout baru dengan menggunakan _$this->extend()_ dan _$this->section()._

Contoh modifikasi app/Views/home.php:

<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= $title; ?></h1>

<hr>

<p><?= $content; ?></p>

<?= $this->endSection() ?>

![image](https://github.com/user-attachments/assets/e028d5a8-6979-4170-8747-c8f51fa09f43)

**3. Membuat View Cell**

Membuat folder Cells di dalam app/ dan membuat file ArtikelTerkini.php menggunakan _php spark make:cell ArtikelTerkini_ untuk menampilkan artikel terkini secara dinamis.

![image](https://github.com/user-attachments/assets/ab8a3f27-51f0-493e-b6d8-128c3b46dbd6)


**4. Membuat View Component**

Membuat folder components di dalam app/Views/components dan membuat file artikel_terkini.php untuk template artikel terkini.

![image](https://github.com/user-attachments/assets/83fbd0a7-7464-462a-bf5a-2358dbbc55b0)

Setelah implementasi View Layout dan View Cell, tampilan website menjadi lebih terstruktur dan modular:

- Layout utama yang konsisten di semua halaman
- Sidebar yang menampilkan artikel terkini secara dinamis
- Kode yang lebih mudah di-maintain dan reusable

# Praktikum 4

**Langkah Langkah :**

**1. Persiapan Database**
Membuat tabel user untuk sistem login.

_CREATE TABLE user (
    id INT(11) auto_increment,
    username VARCHAR(200) NOT NULL,
    useremail VARCHAR(200),
    userpassword VARCHAR(200),
    PRIMARY KEY(id)
);_

![image](https://github.com/user-attachments/assets/29c41bfd-9ddf-45b2-a4c1-31b2eb1f414e)


**2. Membuat Model User**

Membuat file UserModel.php di app/Models/ menggunakan _php spark make:model userModel_ untuk mengelola data user.

![image](https://github.com/user-attachments/assets/fea0387a-081a-44cb-8e9d-3804eeb6db4c)

**3. Membuat Controller User**

Membuat file User.php di app/Controllers/ menggunakan _php spark make:controller user_ dengan method untuk login dan logout.

![image](https://github.com/user-attachments/assets/8c0e5513-5936-464e-b57b-40812710519f)

**4. Membuat View Login**

Membuat direktori user di app/views/ dan membuat file login.php untuk form login.

![image](https://github.com/user-attachments/assets/85d51ebe-9149-4bba-90ff-b7ac03b0a067)

**5. Membuat Database Seeder**

Membuat seeder untuk data dummy user menggunakan CLI. _php spark make:seeder userSeeder_

kemudian isi file UserSeeder.php :

![image](https://github.com/user-attachments/assets/e34c9ffa-67cf-4d22-843f-b82368481512)

untuk menjalankan seeder menggunakan command cli : _php spark db:seed UserSeeder_

![image](https://github.com/user-attachments/assets/0c409ded-e900-464e-ab0a-a0c60fdce09b)

**6. Membuat Middleware Auth**

Membuat filter menggunakan _php spark make:filter Auth_ untuk proteksi halaman admin di app/Filters/Auth.php.

![image](https://github.com/user-attachments/assets/350a7fef-645e-4f96-a59e-b15d4b1ffb74)

**7. Konfigurasi Filter**

tambahkan filter auth yang tadi dengan menambahkan baris **'auth' => App\Filters\Auth::class** ke dalam file App/config/filters.php di bagian aliases

![image](https://github.com/user-attachments/assets/2c6177bb-4bb4-400d-92f0-e6856ee91d48)

**8. Konfigurasi Routes**

Mengupdate routes agar halaman login bisa di akses dan  menggunakan filter auth pada halaman admin :

![image](https://github.com/user-attachments/assets/4b01a27e-04b6-4f4b-9f56-0b467a5fe0ec)

**9. Test sistem login**

Mengakses halaman admin tanpa login akan redirect ke halaman login:

- URL: http://localhost:8080/admin/artikel
- Akan redirect ke: http://localhost:8080/user/login

**10. Login Dengan Kredensial**

Login menggunakan:

Email: admin@email.com
Password: admin123

Setelah login berhasil, akan redirect ke halaman admin artikel.

# Praktikum 5

**Langkah Langkah :**

**1. Membuat Pagination**

Pagination merupakan proses yang digunakan untuk membatasi tampilan data yang panjang dengan memecah tampilan menjadi beberapa halaman.

Modifikasi Controller Artikel pada method admin_index():

```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $model = new ArtikelModel();
    $data = [
        'title' => $title,
        'artikel' => $model->paginate(10), // data dibatasi 10 record per halaman
        'pager' => $model->pager,
    ];
    return view('artikel/admin_index', $data);
}
```

Tambahkan kode pagination di file views/artikel/admin_index.php:

```php
<?= $pager->links(); ?>
```

**2. Membuat Pencarian**

Pencarian data digunakan untuk memfilter data berdasarkan kata kunci tertentu.

Modifikasi method admin_index() untuk mendukung pencarian:

```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $q = $this->request->getVar('q') ?? '';
    $model = new ArtikelModel();
    $data = [
        'title' => $title,
        'q' => $q,
        'artikel' => $model->like('judul', $q)->paginate(10), // data dibatasi 10 record per halaman
        'pager' => $model->pager,
    ];
    return view('artikel/admin_index', $data);
}
```

Tambahkan form pencarian di file views/artikel/admin_index.php:

```php
<form method="get" class="form-search">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari data">
    <input type="submit" value="Cari" class="btn btn-primary">
</form>
```

Update link pager untuk mempertahankan parameter pencarian:

```php
<?= $pager->only(['q'])->links(); ?>
```

**3. Testing Fitur**

- Pagination: Menampilkan maksimal 10 artikel per halaman dengan navigasi halaman
- Pencarian: Filter artikel berdasarkan judul dengan kata kunci tertentu
- Kombinasi: Pencarian dengan pagination yang tetap mempertahankan kata kunci


# Kesimpulan

**Praktikum 1 :**

CodeIgniter 4 memudahkan pengembangan aplikasi web dengan arsitektur MVC yang jelas. Framework ini menyediakan struktur yang baik untuk memisahkan logika aplikasi, memudahkan maintenance, dan meningkatkan produktivitas development.

**Praktikum 2 :**

Praktikum ini berhasil mengimplementasikan sistem CRUD sederhana menggunakan CodeIgniter 4 dengan fitur:

- Manajemen artikel (Create, Read, Update, Delete)
- Validasi form
- Routing yang terstruktur
- Pemisahan logic dengan pattern MVC
- Interface admin untuk pengelolaan data

**Praktikum 3 :**

Praktikum View Layout dan View Cell memberikan pemahaman tentang:

- Penggunaan layout template yang konsisten
- Implementasi View Cell untuk komponen yang dapat digunakan ulang
- Struktur kode yang lebih modular dan maintainable
- Pemisahan concern antara layout, content, dan komponen

**Praktikum 4 :**

Praktikum sistem login berhasil mengimplementasikan:

- Sistem autentikasi user dengan password hashing
- Session management untuk maintain login state
- Filter untuk proteksi halaman admin
- Redirect system untuk unauthorized access
- Database seeder untuk data dummy user

**Praktikum 5 :**

Praktikum pagination dan pencarian berhasil mengimplementasikan:

- Sistem pagination untuk membatasi tampilan data per halaman
- Fitur pencarian dengan filter berdasarkan judul artikel
- Integrasi pagination dengan pencarian yang seamless
- Penggunaan library pagination CodeIgniter 4 yang mudah digunakan

Semua fitur berfungsi dengan baik dan sesuai dengan requirements yang diberikan. Kombinasi dari kelima praktikum ini memberikan pemahaman yang komprehensif tentang penggunaan CodeIgniter 4 dari konsep dasar hingga implementasi aplikasi web yang lebih kompleks dengan sistem keamanan, pagination, dan pencarian.
