<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Главная | HGS CMS'
        ];
        return view('themes/public/home', $data);
    }
}