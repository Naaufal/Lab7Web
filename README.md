💻 Lab7Web - PHP Framework (CodeIgniter 4)
Praktikum ini mempelajari konsep dasar framework PHP CodeIgniter 4 dengan fokus pada arsitektur MVC dan pembuatan aplikasi web sederhana.

📁 Praktikum 1: Sistem MVC
Langkah-Langkah
Instalasi CodeIgniter 4
Install CodeIgniter 4 menggunakan Composer:
composer create-project codeigniter4/appstarter . --no-dev

Akses aplikasi di browser melalui URL:http://localhost:8081/lab11_php_ci/public/  
Jika berhasil, halaman Welcome to CodeIgniter 4 akan muncul.
Konfigurasi Dasar
Aktifkan mode debugging:

Ubah nama file env menjadi .env.
Setel konfigurasi lingkungan di file .env:

CI_ENVIRONMENT = development

Implementasi MVC
1. Routing
Tambahkan rute di file app/Config/Routes.php:
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

2. Controller
Buat controller menggunakan perintah CLI:
php spark make:controller Page

Contoh isi file app/Controllers/Page.php:
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

3. View dengan Template

Template Header (app/Views/layout/main.php):

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
            <a href="<?= base_url('/'); ?>" class="<?= uri_string() == '' ? 'active' : ''; ?>">Home</a>
            <a href="<?= base_url('/artikel'); ?>" class="<?= str_starts_with(uri_string(), 'artikel') ? 'active' : ''; ?>">Artikel</a>
            <a href="<?= base_url('/about'); ?>" class="<?= str_starts_with(uri_string(), 'about') ? 'active' : ''; ?>">About</a>
            <a href="<?= base_url('/contact'); ?>" class="<?= str_starts_with(uri_string(), 'contact') ? 'active' : ''; ?>">Contact</a>
        </nav>
        <section id="wrapper">
            <section id="main">


Template Footer (app/Views/layout/main.php):

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


View Pages (contoh app/Views/about.php):

<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->endSection() ?>

Hasil tampilan about.php:

📁 Praktikum 2: Sistem CRUD Artikel
Langkah-Langkah
1. Persiapan Database
Buat database dan tabel untuk menyimpan data artikel.
Membuat Database:
CREATE DATABASE lab_ci4;

Membuat Tabel Artikel:
CREATE TABLE artikel (
    id INT(11) AUTO_INCREMENT,
    judul VARCHAR(200) NOT NULL,
    isi TEXT,
    gambar VARCHAR(200),
    status T Purity(1) DEFAULT 0,
    slug VARCHAR(200),
    PRIMARY KEY(id)
);


2. Konfigurasi Database
Konfigurasi koneksi database di file .env:
database.default.hostname = localhost
database.default.database = lab_ci4
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

3. Membuat Model
Buat model ArtikelModel menggunakan perintah:
php spark make:model ArtikelModel

Isi file app/Models/ArtikelModel.php:
<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar'];
    protected $useTimestamps = true;
}

4. Membuat Controller
Buat controller Artikel menggunakan perintah:
php spark make:controller Artikel

Contoh isi file app/Controllers/Artikel.php:
<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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

5. Membuat View
Buat file app/Views/artikel/index.php untuk menampilkan daftar artikel:
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<hr>

<?php if($artikel): foreach($artikel as $row): ?>
<article class="entry">
    <h2><a href="<?= base_url('/artikel/' . $row['slug']); ?>"><?= $row['judul']; ?></a></h2>
    <?php if($row['gambar']): ?>
        <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" alt="<?= $row['judul']; ?>">
    <?php endif; ?>
    <p><?= substr($row['isi'], 0, 200); ?></p>
</article>
<hr class="divider" />
<?php endforeach; else: ?>
<article class="entry">
    <h2>Belum ada data.</h2>
</article>
<?php endif; ?>
<?= $this->endSection() ?>

6. Menambahkan Data Sampel
Tambahkan data sampel ke database untuk pengujian:
INSERT INTO artikel (judul, isi, slug) VALUES
('Artikel pertama', 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.', 'artikel-pertama'),
('Artikel kedua', 'Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah teks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari 2000 tahun.', 'artikel-kedua');

7. Membuat Halaman Detail Artikel
Tambahkan method view() di controller Artikel.php dan buat file view app/Views/artikel/detail.php:
<?= $this->include('template/header') ?>

<article class="entry">
    <h2><?= $artikel['judul']; ?></h2>
    <?php if($artikel['gambar']): ?>
        <img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" alt="<?= $artikel['judul']; ?>">
    <?php endif; ?>
    <p><?= $artikel['isi']; ?></p>
</article>

<?= $this->include('template/footer') ?>


8. Membuat Menu Admin
Buat method untuk halaman admin di controller Artikel.php dan file view app/Views/artikel/admin_index.php:
<?= $this->include('template/admin_header') ?>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if($artikel): foreach($artikel as $row): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td>
                <b><?= $row['judul']; ?></b>
                <p><small><?= substr($row['isi'], 0, 50); ?></small></p>
            </td>
            <td><?= $row['status']; ?></td>
            <td>
                <a class="btn" href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
                <a class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="4">Belum ada data.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->include('template/admin_footer') ?>


9. Membuat Routing
Tambahkan routing untuk admin di file app/Config/Routes.php:
$routes->group('admin', function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

10. Implementasi CRUD

Menambah Data (method add di Artikel.php):

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


Update Data (method edit di Artikel.php):

public function edit($id)
{
    $artikel = new ArtikelModel();
    $validation = \Config\Services::validation();
    $validation->setRules(['judul' => 'required']);
    $isDataValid = $validation->withRequest($this->request)->run();

    if ($isDataValid) {
        $artikel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
        ]);
        return redirect('admin/artikel');
    }

    $data = $artikel->where('id', $id)->first();
    $title = "Edit Artikel";
    return view('artikel/form_edit', compact('title', 'data'));
}


Delete Data (method delete di Artikel.php):

public function delete($id)
{
    $artikel = new ArtikelModel();
    $artikel->delete($id);
    return redirect('admin/artikel');
}


📁 Praktikum 3: View Layout dan View Cell
Langkah-Langkah
1. Membuat Layout Utama
Buat folder layout di app/Views/ dan file main.php sebagai template utama aplikasi.
2. Modifikasi View dengan Layout
Ubah view yang ada untuk menggunakan layout dengan extend dan section. Contoh app/Views/home.php:
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<?= $this->endSection() ?>


3. Membuat View Cell
Buat file ArtikelTerkini.php di folder app/Cells/ menggunakan perintah:
php spark make:cell ArtikelTerkini

Isi file app/Cells/ArtikelTerkini.php:
<?php

namespace App\Cells;

use App\Models\ArtikelModel;
use CodeIgniter\View\Cells\Cell;

class ArtikelTerkini extends Cell
{
    public function render(): string
    {
        $model = new ArtikelModel();
        $artikel = $model->orderBy('created_at', 'DESC')->limit(5)->findAll();

        return view('components/artikel_terkini', ['artikel' => $artikel]);
    }
}

4. Membuat View Component
Buat folder components di app/Views/ dan file artikel_terkini.php:
<div class="widget-box">
    <h3 class="title">Artikel Terkini</h3>
    <ul>
        <?php foreach ($artikel as $row): ?>
            <li><a href="<?= base_url('/artikel/' . $row['slug']) ?>"><?= $row['judul'] ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

Hasil Implementasi:

Layout utama yang konsisten di semua halaman.
Sidebar dengan artikel terkini secara dinamis.
Kode modular dan mudah dipelihara.


📁 Praktikum 4: Sistem Login
Langkah-Langkah
1. Persiapan Database
Buat tabel user untuk sistem login:
CREATE TABLE user (
    id INT(11) AUTO_INCREMENT,
    username VARCHAR(200) NOT NULL,
    useremail VARCHAR(200),
    userpassword VARCHAR(200),
    PRIMARY KEY(id)
);


2. Membuat Model User
Buat model UserModel menggunakan perintah:
php spark make:model UserModel

Isi file app/Models/UserModel.php:
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

3. Membuat Controller User
Buat controller User menggunakan perintah:
php spark make:controller User

Isi file app/Controllers/User.php:
<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $title = 'Daftar User';
        $model = new UserModel();
        $users = $model->findAll();
        return view('user/index', compact('users', 'title'));
    }

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
            } else {
                $session->setFlashdata("flash_msg", "Password salah.");
                return redirect()->to('/user/login');
            }
        } else {
            $session->setFlashdata("flash_msg", "Email tidak terdaftar.");
            return redirect()->to('/user/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}

4. Membuat View Login
Buat file app/Views/user/login.php untuk form login:
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>
    <div id="login-wrapper">
        <h1>Sign In</h1>
        <?php if(session()->getFlashdata('flash_msg')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('flash_msg') ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="InputForEmail" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="InputForEmail" value="<?= set_value('email') ?>">
            </div>
            <div class="mb-3">
                <label for="InputForPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="InputForPassword">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>

5. Membuat Database Seeder
Buat seeder untuk data dummy user:
php spark make:seeder UserSeeder

Isi file app/Database/Seeds/UserSeeder.php:
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

Jalankan seeder dengan perintah:
php spark db:seed UserSeeder


6. Membuat Middleware Auth
Buat filter Auth menggunakan perintah:
php spark make:filter Auth

Isi file app/Filters/Auth.php:
<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/user/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}

7. Konfigurasi Filter
Tambahkan filter auth di file app/Config/Filters.php:
public array $aliases = [
    'csrf'          => CSRF::class,
    'toolbar'       => DebugToolbar::class,
    'honeypot'      => Honeypot::class,
    'invalidchars'  => InvalidChars::class,
    'secureheaders' => SecureHeaders::class,
    'cors'          => Cors::class,
    'forcehttps'    => ForceHTTPS::class,
    'pagecache'     => PageCache::class,
    'performance'   => PerformanceMetrics::class,
    'auth'          => \App\Filters\Auth::class,
];

8. Konfigurasi Routes
Perbarui file app/Config/Routes.php untuk mendukung login dan filter auth:
$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:any)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:any)', 'Artikel::delete/$1');
});

9. Test Sistem Login

Akses halaman admin tanpa login (http://localhost:8080/admin/artikel) akan redirect ke /user/login.
Login menggunakan kredensial:
Email: admin@email.com
Password: admin123


Setelah login berhasil, pengguna akan diarahkan ke halaman admin artikel.


📁 Praktikum 5: Pagination dan Pencarian
Langkah-Langkah
1. Membuat Pagination
Modifikasi method admin_index di controller Artikel.php:
public function admin_index()
{
    $title = 'Daftar Artikel';
    $model = new ArtikelModel();
    $data = [
        'title' => $title,
        'artikel' => $model->paginate(10),
        'pager' => $model->pager,
    ];
    return view('artikel/admin_index', $data);
}

Tambahkan kode pagination di app/Views/artikel/admin_index.php:
<?= $pager->links(); ?>

2. Membuat Pencarian
Modifikasi method admin_index untuk mendukung pencarian:
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

Tambahkan form pencarian di app/Views/artikel/admin_index.php:
<form method="get" class="form-search">
    <input type="text" name="q" value="<?= $q; ?>" placeholder="Cari data">
    <input type="submit" value="Cari" class="btn btn-primary">
</form>

Perbarui link pager untuk mempertahankan parameter pencarian:
<?= $pager->only(['q'])->links(); ?>

3. Testing Fitur

Pagination: Menampilkan maksimal 10 artikel per halaman dengan navigasi halaman.
Pencarian: Filter artikel berdasarkan judul dengan kata kunci tertentu.
Kombinasi: Pencarian dengan pagination yang mempertahankan kata kunci.


📝 Kesimpulan
Praktikum 1
CodeIgniter 4 memudahkan pengembangan aplikasi web dengan arsitektur MVC yang jelas, memisahkan logika aplikasi, memudahkan maintenance, dan meningkatkan produktivitas.
Praktikum 2
Berhasil mengimplementasikan sistem CRUD sederhana dengan fitur:

Manajemen artikel (Create, Read, Update, Delete).
Validasi form.
Routing terstruktur.
Pemisahan logika dengan pola MVC.
Interface admin untuk pengelolaan data.

Praktikum 3
Memberikan pemahaman tentang:

Penggunaan layout template yang konsisten.
Implementasi View Cell untuk komponen reusable.
Struktur kode modular dan maintainable.
Pemisahan concern antara layout, content, dan komponen.

Praktikum 4
Berhasil mengimplementasikan sistem login dengan:

Autentikasi user dengan password hashing.
Session management untuk status login.
Filter untuk proteksi halaman admin.
Redirect untuk akses tanpa izin.
Database seeder untuk data dummy user.

Praktikum 5
Berhasil mengimplementasikan:

Pagination untuk membatasi tampilan data per halaman.
Pencarian dengan filter berdasarkan judul artikel.
Integrasi pagination dan pencarian yang seamless.
Penggunaan library pagination CodeIgniter 4.

Semua fitur berfungsi sesuai kebutuhan, memberikan pemahaman komprehensif tentang CodeIgniter 4 dari konsep dasar hingga aplikasi web kompleks dengan keamanan, pagination, dan pencarian.
