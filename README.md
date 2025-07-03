# Lab7Web - PHP Framework (CodeIgniter 4)

Praktikum ini mempelajari konsep dasar framework PHP CodeIgniter 4 dengan fokus pada arsitektur MVC dan pembuatan aplikasi web sederhana.

**Praktikum 1 : sistem MVC**

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

**Praktikum 2 : Sistem CRUD artikel**

# Kesimpulan
CodeIgniter 4 memudahkan pengembangan aplikasi web dengan arsitektur MVC yang jelas. Framework ini menyediakan struktur yang baik untuk memisahkan logika aplikasi, memudahkan maintenance, dan meningkatkan produktivitas development.
