# Lab7Web - PHP Framework (CodeIgniter 4)

Praktikum ini mempelajari konsep dasar framework PHP CodeIgniter 4 dengan fokus pada arsitektur MVC dan pembuatan aplikasi web sederhana.

# **Langkah Langkah**

# Instalasi CodeIgniter 4

instalasi menggunakan composer :

composer create-project codeigniter4/appstarter . --no-dev

Untuk memastikan instalasi berhasil, akses http://localhost:8081/lab11_php_ci/public/ dan halaman welcome CodeIgniter 4 akan muncul.
![image](https://github.com/user-attachments/assets/d7e1ab9b-9028-4995-b4f5-3b519bddc1d2)

# Konfigurasi Dasar

Mengaktifkan Mode Debugging :
  - Ubah file env menjadi .env
  - Set CI_ENVIRONMENT = development
![image](https://github.com/user-attachments/assets/5f37b005-d5c7-4b4f-b4e4-388dbda1d8a3)

# Implementasi MVC
1. Routing

Menambahkan Route ke app/config/Routes.php :
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
   
2. Controller

Buat file controller menggunakan CLI : php spark make:controller page
![image](https://github.com/user-attachments/assets/b6ecb5e9-3ae2-4ee6-9647-9efbb8bb668f)

3. View dengan template
