<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    protected $validation;
    protected $userModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $rules = [
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'password' => ['label' => 'Пароль', 'rules' => 'required|min_length[6]']
            ];

            if (!$this->validate($rules)) {
                return view('themes/public/auth/login', [
                    'title' => 'Вход | HGS CMS',
                    'validation' => $this->validation
                ]);
            }

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/')->with('success', 'Вход выполнен успешно!');
            }

            session()->setFlashdata('error', 'Неверный email или пароль');
            return view('themes/public/auth/login', [
                'title' => 'Вход | HGS CMS',
                'validation' => $this->validation
            ]);
        }

        return view('themes/public/auth/login', [
            'title' => 'Вход | HGS CMS'
        ]);
    }

    public function register()
    {
        if ($this->request->is('post')) {
            // Правила валидации
            $rules = [
                'username' => ['label' => 'Имя пользователя', 'rules' => 'required|min_length[3]|is_unique[users.username]'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email]'],
                'password' => ['label' => 'Пароль', 'rules' => 'required|min_length[6]'],
                'password_confirm' => ['label' => 'Подтверждение пароля', 'rules' => 'required|matches[password]']
            ];

            if (!$this->validate($rules)) {
                return view('themes/public/auth/register', [
                    'title' => 'Регистрация | HGS CMS',
                    'validation' => $this->validation
                ]);
            }

            // Сохранение пользователя
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'), // Хешируется в модели
                'role' => 'user'
            ];

            if ($this->userModel->insert($data)) {
                session()->setFlashdata('success', 'Регистрация успешна! Войдите в аккаунт.');
                return redirect()->to('/login');
            }

            session()->setFlashdata('error', 'Ошибка при регистрации. Попробуйте снова.');
            return view('themes/public/auth/register', [
                'title' => 'Регистрация | HGS CMS',
                'validation' => $this->validation
            ]);
        }

        return view('themes/public/auth/register', [
            'title' => 'Регистрация | HGS CMS'
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Вы вышли из системы.');
    }
}