# Modul Praktikum Pemrograman Web 2
## Framework CodeIgniter 4

**Dosen:** Agung Nugroho (agung@pelitabangsa.ac.id)  
**Universitas:** Pelita Bangsa, Bekasi

---

## Daftar Isi

1. [Praktikum 1: Framework Dasar (CRUD)](#praktikum-1-sistem-MVC)
2. [Praktikum 2: Framework Lanjutan (CRUD)](#praktikum-2-framework-lanjutan-crud)
3. [Praktikum 3: View Layout dan View Cell](#praktikum-3-view-layout-dan-view-cell)
4. [Praktikum 4: Framework Lanjutan (Modul Login)](#praktikum-4-framework-lanjutan-modul-login)
5. [Praktikum 5: Pagination dan Pencarian](#praktikum-5-pagination-dan-pencarian)
6. [Praktikum 6: Upload File Gambar](#praktikum-6-upload-file-gambar)

---

## Praktikum 1 : sistem MVC

**Langkah Langkah**

**Instalasi CodeIgniter 4**

instalasi menggunakan composer :

```bash
composer create-project codeigniter4/appstarter . --no-dev
```

Untuk memastikan instalasi berhasil, akses http://localhost:8081/lab11_php_ci/public/ dan halaman welcome CodeIgniter 4 akan muncul.
![image](https://github.com/user-attachments/assets/d7e1ab9b-9028-4995-b4f5-3b519bddc1d2)

**Konfigurasi Dasar**

Mengaktifkan Mode Debugging :
  - Ubah file env menjadi .env
  - Set CI_ENVIRONMENT = development

```php
CI_ENVIRONMENT = development
```

**Implementasi MVC**
1. Routing
   Menambahkan Route ke app/config/Routes.php :
  ```php
  $routes->get('/about', 'Page::about');
  $routes->get('/contact', 'Page::contact');
  $routes->get('/faqs', 'Page::faqs');
  ```

3. Controller
Buat file controller menggunakan CLI : ```php spark make:controller page```
```php
<?php

namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        return view('about', [
            'title' => 'Halaman About',
            'content' => 'Ini adalah halaman about yang menjelaskan tentang isi halaman ini.'
        ]);
    }

    public function contact()
    {
        return view('contact', [
            'title' => 'Halaman Contact',
            'content' => 'Ini adalah halaman contact untuk menghubungi kami.'
        ]);
    }

    public function faqs()
    {
        return view('faqs', [
            'title' => 'Halaman FAQ',
            'content' => 'Ini adalah halaman FAQ yang berisi pertanyaan yang sering diajukan.'
        ]);
    }

    public function tos()
    {
        echo "Ini halaman Terms of Services";
    }
}
```

4. View dengan template
  - Template Header :
    ```html
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $title; ?></title>
        <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
    </head>
    <body>
        <div id="container">
            <header>
                <h1>Layout Sederhana</h1>
            </header>
            <nav>
                <a href="<?= base_url('/'); ?>"
                   class="<?= uri_string() == '' ? 'active' : ''; ?>">Home</a>
    
                <a href="<?= base_url('/artikel'); ?>"
                   class="<?= str_starts_with(uri_string(), 'artikel') ? 'active' : ''; ?>">Artikel</a>
    
                <a href="<?= base_url('/about'); ?>"
                   class="<?= str_starts_with(uri_string(), 'about') ? 'active' : ''; ?>">About</a>
    
                <a href="<?= base_url('/contact'); ?>"
                   class="<?= str_starts_with(uri_string(), 'contact') ? 'active' : ''; ?>">Contact</a>
            </nav>
    
            <section id="wrapper">
                <section id="main">
  
    ```  
  
  
  - Template Footer :
    ```html
                    </section>
                <aside id="sidebar">
                    <div class="widget-box">
                        <h3 class="title">Widget Header</h3>
                        <ul>
                            <li><a href="#">Widget Link</a></li>
                            <li><a href="#">Widget Link</a></li>
                        </ul>
                    </div>
                    <div class="widget-box">
                        <h3 class="title">Widget Text</h3>
                        <p>Vestibulum lorem elit, iaculis in nisl volutpat, malesuada tincidunt arcu. Proin in leo fringilla, vestibulum mi porta, faucibus felis. Integer pharetra est nunc, nec pretium nunc pretium ac.</p>
                    </div>
                </aside>
            </section>
            <footer>
                <p>&copy; 2021 - Universitas Pelita Bangsa</p>
            </footer>
        </div>
    </body>
    </html>
    ```

  - View Pages (contoh about.php)
    ```php
    <?= $this->extend('layout/main') ?>
    
    <?= $this->section('content') ?>
    <h1><?= $title; ?></h1>
    <hr>
    <p><?= $content; ?></p>
    <?= $this->endSection() ?>
    ```

hasil dari view about.php :

![image](https://github.com/user-attachments/assets/4328eaf7-49fc-47ff-b9bd-e3eb28c4db66)

## Praktikum 2: Framework Lanjutan (CRUD)

### Tujuan
- Memahami konsep dasar Model
- Memahami konsep dasar CRUD
- Membuat program sederhana menggunakan Framework CodeIgniter 4

### Persiapan
1. Persiapkan text editor (VSCode)
2. Buka folder `lab7_php_ci` pada docroot webserver (htdocs)
3. Pastikan MySQL Server sudah berjalan melalui XAMPP

### Langkah-langkah

#### 1. Membuat Database dan Tabel

```sql
-- Membuat Database
CREATE DATABASE lab_ci4;

-- Membuat Tabel Artikel
CREATE TABLE artikel (
    id INT(11) auto_increment,
    judul VARCHAR(200) NOT NULL,
    isi TEXT,
    gambar VARCHAR(200),
    status TINYINT(1) DEFAULT 0,
    slug VARCHAR(200),
    PRIMARY KEY(id)
);
```

#### 2. Konfigurasi Database
Edit file `.env` untuk konfigurasi database:
```env
database.default.hostname = localhost
database.default.database = lab_ci4
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

#### 3. Membuat Model
Buat file `app/Models/ArtikelModel.php`:
```php
<?php
namespace App\Models;
use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar'];
}
```

#### 4. Membuat Controller
Buat file `app/Controllers/Artikel.php`:
```php
<?php
namespace App\Controllers;
use App\Models\ArtikelModel;

class Artikel extends BaseController
{
    public function index()
    {
        $title = 'Daftar Artikel';
        $model = new ArtikelModel();
        $artikel = $model->findAll();
        return view('artikel/index', compact('artikel', 'title'));
    }
}
```

#### 5. Membuat View
Buat direktori `app/views/artikel/` dan file `index.php`:
```php
<?= $this->include('template/header'); ?>
<?php if($artikel): foreach($artikel as $row): ?>
<article class="entry">
    <h2><a href="<?= base_url('/artikel/' . $row['slug']);?>"><?= $row['judul']; ?></a></h2>
    <img src="<?= base_url('/gambar/' . $row['gambar']);?>" alt="<?= $row['judul']; ?>">
    <p><?= substr($row['isi'], 0, 200); ?></p>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>
<?= $this->include('template/footer'); ?>
```

#### 6. Tambah Data Sample
```sql
INSERT INTO artikel (judul, isi, slug) VALUE
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy...', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang...', 'artikel-kedua');
```

#### 7. Membuat Detail Artikel
Tambahkan method `view()` pada Controller:
```php
public function view($slug)
{
    $model = new ArtikelModel();
    $artikel = $model->where(['slug' => $slug])->first();
    
    if (!$artikel) {
        throw PageNotFoundException::forPageNotFound();
    }
    
    $title = $artikel['judul'];
    return view('artikel/detail', compact('artikel', 'title'));
}
```

#### 8. Routing untuk Detail
Edit `app/config/Routes.php`:
```php
$routes->get('/artikel/(:any)', 'Artikel::view/$1');
```

#### 9. Menu Admin untuk CRUD
Tambahkan method `admin_index()`, `add()`, `edit()`, dan `delete()`:

**Admin Index:**
```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $model = new ArtikelModel();
    $artikel = $model->findAll();
    return view('artikel/admin_index', compact('artikel', 'title'));
}
```

**Add Method:**
```php
public function add()
{
    $validation = \Config\Services::validation();
    $validation->setRules(['judul' => 'required']);
    $isDataValid = $validation->withRequest($this->request)->run();
    
    if ($isDataValid) {
        $artikel = new ArtikelModel();
        $artikel->insert([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'slug' => url_title($this->request->getPost('judul')),
        ]);
        return redirect('admin/artikel');
    }
    
    $title = "Tambah Artikel";
    return view('artikel/form_add', compact('title'));
}
```

#### 10. Routing Admin
```php
$routes->group('admin', function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});
```

---

## Praktikum 3: View Layout dan View Cell

### Tujuan
- Memahami konsep View Layout di CodeIgniter 4
- Menggunakan View Layout untuk membuat template tampilan
- Memahami dan mengimplementasikan View Cell

### Langkah-langkah

#### 1. Membuat Layout Utama
Buat folder `app/Views/layout/` dan file `main.php`:
```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My Website' ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css');?>">
</head>
<body>
    <div id="container">
        <header>
            <h1>Layout Sederhana</h1>
        </header>
        <nav>
            <a href="<?= base_url('/');?>" class="active">Home</a>
            <a href="<?= base_url('/artikel');?>">Artikel</a>
            <a href="<?= base_url('/about');?>">About</a>
            <a href="<?= base_url('/contact');?>">Kontak</a>
        </nav>
        <section id="wrapper">
            <section id="main">
                <?= $this->renderSection('content') ?>
            </section>
            <aside id="sidebar">
                <?= view_cell('App\\Cells\\ArtikelTerkini::render') ?>
            </aside>
        </section>
        <footer>
            <p>&copy; 2021 - Universitas Pelita Bangsa</p>
        </footer>
    </div>
</body>
</html>
```

#### 2. Modifikasi View Home
Edit `app/Views/home.php`:
```php
<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->endSection() ?>
```

#### 3. Membuat View Cell
Buat folder `app/Cells/` dan file `ArtikelTerkini.php`:
```php
<?php
namespace App\Cells;
use CodeIgniter\View\Cell;
use App\Models\ArtikelModel;

class ArtikelTerkini extends Cell
{
    public function render()
    {
        $model = new ArtikelModel();
        $artikel = $model->orderBy('created_at', 'DESC')->limit(5)->findAll();
        return view('components/artikel_terkini', ['artikel' => $artikel]);
    }
}
```

#### 4. View untuk View Cell
Buat folder `app/Views/components/` dan file `artikel_terkini.php`:
```php
<h3>Artikel Terkini</h3>
<ul>
<?php foreach ($artikel as $row): ?>
    <li><a href="<?= base_url('/artikel/' . $row['slug']) ?>"><?= $row['judul'] ?></a></li>
<?php endforeach; ?>
</ul>
```

---

## Praktikum 4: Framework Lanjutan (Modul Login)

### Tujuan
- Memahami konsep dasar Auth dan Filter
- Memahami konsep dasar Login System
- Membuat modul login menggunakan Framework CodeIgniter 4

### Langkah-langkah

#### 1. Membuat Tabel User
```sql
CREATE TABLE user (
    id INT(11) auto_increment,
    username VARCHAR(200) NOT NULL,
    useremail VARCHAR(200),
    userpassword VARCHAR(200),
    PRIMARY KEY(id)
);
```

#### 2. Membuat Model User
Buat file `app/Models/UserModel.php`:
```php
<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'useremail', 'userpassword'];
}
```

#### 3. Membuat Controller User
Buat file `app/Controllers/User.php`:
```php
<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        helper(['form']);
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        if (!$email) {
            return view('user/login');
        }
        
        $session = session();
        $model = new UserModel();
        $login = $model->where('useremail', $email)->first();
        
        if ($login) {
            $pass = $login['userpassword'];
            if (password_verify($password, $pass)) {
                $login_data = [
                    'user_id' => $login['id'],
                    'user_name' => $login['username'],
                    'user_email' => $login['useremail'],
                    'logged_in' => TRUE,
                ];
                $session->set($login_data);
                return redirect('admin/artikel');
            }
        }
        
        $session->setFlashdata("flash_msg", "Login gagal.");
        return redirect()->to('/user/login');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}
```

#### 4. Membuat Database Seeder
```bash
php spark make:seeder UserSeeder
```

Edit file `app/Database/Seeds/UserSeeder.php`:
```php
<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $model = model('UserModel');
        $model->insert([
            'username' => 'admin',
            'useremail' => 'admin@email.com',
            'userpassword' => password_hash('admin123', PASSWORD_DEFAULT),
        ]);
    }
}
```

Jalankan seeder:
```bash
php spark db:seed UserSeeder
```

#### 5. Membuat Auth Filter
Buat file `app/Filters/Auth.php`:
```php
<?php 
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(! session()->get('logged_in')){
            return redirect()->to('/user/login');
        }
    }
    
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
```

#### 6. Konfigurasi Filter
Edit `app/Config/Filters.php`:
```php
'auth' => App\Filters\Auth::class
```

Edit `app/Config/Routes.php`:
```php
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});
```

---

## Praktikum 5: Pagination dan Pencarian

### Tujuan
- Memahami konsep dasar Pagination
- Memahami konsep dasar Pencarian
- Membuat Paging dan Pencarian menggunakan Framework CodeIgniter 4

### Langkah-langkah

#### 1. Membuat Pagination
Modifikasi method `admin_index()` pada Controller Artikel:
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

#### 2. Tambahkan Pagination ke View
Edit `app/Views/artikel/admin_index.php`, tambahkan di bawah tabel:
```php
<?= $pager->links(); ?>
```

#### 3. Membuat Pencarian
Modifikasi method `admin_index()`:
```php
public function admin_index()
{
    $title = 'Daftar Artikel';
    $q = $this->request->getVar('q') ?? '';
    $model = new ArtikelModel();
    $data = [
        'title' => $title,
        'q' => $q,
        'artikel' => $model->like('judul', $q)->paginate(10),
        'pager' => $model->pager,
    ];
    return view('artikel/admin_index', $data);
}
```

#### 4. Tambahkan Form Pencarian
Edit `app/Views/artikel/admin_index.php`, tambahkan sebelum tabel:
```php
<form method="get" class="form-search">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari data">
    <input type="submit" value="Cari" class="btn btn-primary">
</form>
```

#### 5. Update Link Pager
```php
<?= $pager->only(['q'])->links(); ?>
```

---

## Praktikum 6: Upload File Gambar

### Tujuan
- Memahami konsep dasar File Upload
- Membuat File Upload menggunakan Framework CodeIgniter 4

### Langkah-langkah

#### 1. Modifikasi Method Add
Edit method `add()` pada Controller Artikel:
```php
public function add()
{
    $validation = \Config\Services::validation();
    $validation->setRules(['judul' => 'required']);
    $isDataValid = $validation->withRequest($this->request)->run();
    
    if ($isDataValid) {
        $file = $this->request->getFile('gambar');
        $file->move(ROOTPATH . 'public/gambar');
        
        $artikel = new ArtikelModel();
        $artikel->insert([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'slug' => url_title($this->request->getPost('judul')),
            'gambar' => $file->getName(),
        ]);
        return redirect('admin/artikel');
    }
    
    $title = "Tambah Artikel";
    return view('artikel/form_add', compact('title'));
}
```

#### 2. Modifikasi Form Add
Edit `app/Views/artikel/form_add.php`:
```php
<form action="" method="post" enctype="multipart/form-data">
    <p>
        <input type="text" name="judul" placeholder="Judul Artikel">
    </p>
    <p>
        <textarea name="isi" cols="50" rows="10" placeholder="Isi Artikel"></textarea>
    </p>
    <p>
        <input type="file" name="gambar">
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn btn-large">
    </p>
</form>
```

#### 3. Buat Direktori Upload
Buat folder `public/gambar/` untuk menyimpan file upload.

---

## Laporan Praktikum

### Instruksi Umum untuk Semua Praktikum:
1. Melanjutkan praktikum sebelumnya pada repository dengan nama **Lab7Web**
2. Kerjakan semua latihan sesuai urutan
3. Screenshot setiap perubahan
4. Update file README.md dengan penjelasan setiap langkah beserta screenshot
5. Commit hasil ke repository masing-masing
6. Kirim URL repository ke e-learning ecampus

### Struktur Repository yang Diharapkan:
```
Lab7Web/
├── README.md
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   ├── Filters/
│   ├── Cells/
│   └── Database/Seeds/
├── public/
│   ├── gambar/
│   └── style.css
└── screenshots/
    ├── praktikum2/
    ├── praktikum3/
    ├── praktikum4/
    ├── praktikum5/
    └── praktikum6/
```

### Tips Pengerjaan:
- Pastikan XAMPP berjalan sebelum memulai
- Backup database secara berkala
- Test setiap fitur setelah implementasi
- Dokumentasikan error yang ditemui dan solusinya
- Gunakan Git untuk version control yang baik

---

*Modul ini disusun untuk pembelajaran Framework CodeIgniter 4 di Universitas Pelita Bangsa*
