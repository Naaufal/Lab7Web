<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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
        $data = [
            'title' => 'Halaman Contact',
            'content' => 'Ini adalah halaman contact'
        ];
        
        return view('contact', $data); 
    }

    public function faqs()
    {
        echo "ini halaman faqs";
    }
}
