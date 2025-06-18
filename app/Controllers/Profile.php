<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PostModel;

class Profile extends Controller
{
    protected $userModel;
    protected $postModel;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->postModel = new PostModel();
        $this->validation = \Config\Services::validation();
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Пожалуйста, войдите.');
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);
        $posts = $this->postModel->where('user_id', $userId)->findAll();

        $data = [
            'title' => 'Профиль | HGS CMS',
            'user' => $user,
            'posts' => $posts
        ];

        return view('themes/public/function/profile', $data);
    }

    public function edit()
    {
        $userId = session()->get('user_id');
        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->setFlashdata('error', 'Пользователь не найден.');
            return redirect()->to('/profile');
        }

        if ($this->request->getMethod() === 'post') {
            log_message('debug', 'POST data: ' . print_r($this->request->getPost(), true));
            
            $rules = [
                'username' => ['label' => 'Имя пользователя', 'rules' => 'required|min_length[3]|is_unique[users.username,id,' . $userId . ']'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email,id,' . $userId . ']'],
                'password' => ['label' => 'Пароль', 'rules' => 'permit_empty|min_length[6]']
            ];

            if (!$this->validate($rules)) {
                log_message('debug', 'Validation errors: ' . print_r($this->validation->getErrors(), true));
                $data['validation'] = $this->validation;
            } else {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'email' => $this->request->getPost('email')
                ];

                $password = $this->request->getPost('password');
                if (!empty($password)) {
                    $data['password'] = $password;
                }

                log_message('debug', 'Update data: ' . print_r($data, true));
                
                $result = $this->userModel->update($userId, $data);
                log_message('debug', 'Update result: ' . var_export($result, true));
                log_message('debug', 'Last query: ' . $this->userModel->getLastQuery());
                
                if ($result) {
                    log_message('debug', 'Update successful for user ID: ' . $userId);
                    session()->setFlashdata('success', 'Профиль обновлён.');
                    return redirect()->to('/profile');
                } else {
                    log_message('debug', 'Update failed for user ID: ' . $userId);
                    session()->setFlashdata('error', 'Ошибка при обновлении. Проверьте лог.');
                    return redirect()->to('/profile/edit');
                }
            }
        }

        $data = [
            'title' => 'Редактировать профиль | HGS CMS',
            'user' => $user
        ];

        return view('themes/public/function/profile_edit', $data);
    }
}