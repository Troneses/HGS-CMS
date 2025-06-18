<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class AccountController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Пожалуйста, войдите.');
            return redirect()->to('/login');
        }
    }

    public function updateProfile()
    {
        log_message('debug', 'AccountController::updateProfile called for user ID: ' . session()->get('user_id'));
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->setFlashdata('error', 'Пользователь не найден.');
            return redirect()->to('/profile');
        }

        if ($this->request->getMethod() === 'POST') {
            log_message('debug', 'Received POST data: ' . print_r($this->request->getPost(), true));

            $username = trim($this->request->getPost('username'));
            $email = trim($this->request->getPost('email'));
            $password = trim($this->request->getPost('password'));

            if (empty($username) || empty($email)) {
                log_message('debug', 'Validation failed: Username or Email is empty');
                session()->setFlashdata('error', 'Имя пользователя и email обязательны.');
                return redirect()->back()->withInput();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                log_message('debug', 'Validation failed: Invalid email');
                session()->setFlashdata('error', 'Неверный формат email.');
                return redirect()->back()->withInput();
            }

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if (!empty($password)) {
                $data['password'] = $password;
            }

            log_message('debug', 'Data to update: ' . print_r($data, true));
            log_message('debug', 'User ID for update: ' . $userId);

            $result = $this->userModel->update($userId, $data);
            log_message('debug', 'Update result: ' . var_export($result, true));
            log_message('debug', 'Last query: ' . $this->userModel->getLastQuery());

            if ($result) {
                log_message('debug', 'Update successful for user ID: ' . $userId);
                session()->setFlashdata('success', 'Профиль успешно обновлён.');
                return redirect()->to('/profile');
            } else {
                log_message('debug', 'Update failed for user ID: ' . $userId);
                session()->setFlashdata('error', 'Ошибка при обновлении профиля. Проверьте лог.');
                return redirect()->back()->withInput();
            }
        }

        $data = [
            'title' => 'Обновить профиль | HGS CMS',
            'user' => $user
        ];

        return view('themes/public/function/account_update', $data);
    }
}