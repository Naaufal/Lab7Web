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

Semua fitur berfungsi dengan baik dan sesuai dengan requirements yang diberikan. Kombinasi dari kedua praktikum ini memberikan pemahaman yang komprehensif tentang penggunaan CodeIgniter 4 dari konsep dasar hingga implementasi aplikasi web yang lebih kompleks.
