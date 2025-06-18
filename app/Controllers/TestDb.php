<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TestDb extends Controller
{
    public function index()
    {
        try {
            $db = \Config\Database::connect();
            $result = $db->query('SELECT 1')->getResult();
            return 'Подключение к базе данных успешно!';
        } catch (\Exception $e) {
            return 'Ошибка: ' . $e->getMessage();
        }
    }
}