<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\CategoryModel;

class Admin extends Controller
{
    protected $userModel;
    protected $postModel;
    protected $categoryModel;
    protected $validation;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->postModel = new PostModel();
        $this->categoryModel = new CategoryModel();
        $this->validation = \Config\Services::validation();
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Доступ запрещён.');
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        return view('themes/admin/dashboard', [
            'title' => 'Дашборд | HGS CMS'
        ]);
    }

    public function users()
    {
        $data = [
            'title' => 'Пользователи | HGS CMS',
            'users' => $this->userModel->findAll()
        ];
        return view('themes/admin/function/users/list', $data);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'Пользователь не найден.');
            return redirect()->to('/admin/users');
        }

        if ($this->request->is('post')) {
            $rules = [
                'username' => ['label' => 'Имя пользователя', 'rules' => 'required|min_length[3]|is_unique[users.username,id,' . $id . ']'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[users.email,id,' . $id . ']'],
                'role' => ['label' => 'Роль', 'rules' => 'required|in_list[user,admin]']
            ];

            if (!$this->validate($rules)) {
                return view('themes/admin/function/users/edit', [
                    'title' => 'Редактировать пользователя | HGS CMS',
                    'user' => $user,
                    'validation' => $this->validation
                ]);
            }

            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'role' => $this->request->getPost('role')
            ];

            if ($this->userModel->update($id, $data)) {
                session()->setFlashdata('success', 'Пользователь обновлён.');
                return redirect()->to('/admin/users');
            }

            session()->setFlashdata('error', 'Ошибка при обновлении.');
        }

        return view('themes/admin/function/users/edit', [
            'title' => 'Редактировать пользователя | HGS CMS',
            'user' => $user
        ]);
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            session()->setFlashdata('error', 'Пользователь не найден.');
            return redirect()->to('/admin/users');
        }

        if ($this->userModel->delete($id)) {
            session()->setFlashdata('success', 'Пользователь удалён.');
        } else {
            session()->setFlashdata('error', 'Ошибка при удалении.');
        }

        return redirect()->to('/admin/users');
    }

    public function posts()
    {
        $data = [
            'title' => 'Посты | HGS CMS',
            'posts' => $this->postModel->select('posts.*, users.username, categories.name as category_name')
                ->join('users', 'users.id = posts.user_id')
                ->join('categories', 'categories.id = posts.category_id', 'left')
                ->findAll()
        ];
        return view('themes/admin/function/posts/list', $data);
    }

    public function createPost()
    {
        $categories = $this->categoryModel->findAll();
        
        $data = [
            'title' => 'Создать пост | HGS CMS',
            'categories' => $categories
        ];

        if ($this->request->is('post')) {
            $rules = [
                'title' => ['label' => 'Заголовок', 'rules' => 'required|min_length[3]'],
                'slug' => ['label' => 'Слаг', 'rules' => 'required|alpha_dash|is_unique[posts.slug]'],
                'content' => ['label' => 'Содержание', 'rules' => 'required'],
                'category_id' => ['label' => 'Категория', 'rules' => 'permit_empty|is_natural_no_zero']
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validation;
                return view('themes/admin/function/posts/create', $data);
            }

            $slug = $this->request->getPost('slug');
            if (empty($slug)) {
                $slug = generate_slug($this->request->getPost('title'));
            }

            $postData = [
                'title' => $this->request->getPost('title'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'user_id' => session()->get('user_id'),
                'category_id' => $this->request->getPost('category_id') ?: null
            ];

            $suffix = 1;
            $baseSlug = $postData['slug'];
            while ($this->postModel->where('slug', $postData['slug'])->first()) {
                $postData['slug'] = $baseSlug . '-' . $suffix++;
            }

            if ($this->postModel->insert($postData)) {
                session()->setFlashdata('success', 'Пост создан.');
                return redirect()->to('/admin/posts');
            }

            session()->setFlashdata('error', 'Ошибка при создании.');
        }

        return view('themes/admin/function/posts/create', $data);
    }

    public function editPost($id)
    {
        $post = $this->postModel->find($id);
        if (!$post) {
            session()->setFlashdata('error', 'Пост не найден.');
            return redirect()->to('/admin/posts');
        }

        $categories = $this->categoryModel->findAll();
        
        $data = [
            'title' => 'Редактировать пост | HGS CMS',
            'post' => $post,
            'categories' => $categories
        ];

        if ($this->request->is('post')) {
            $rules = [
                'title' => ['label' => 'Заголовок', 'rules' => 'required|min_length[3]'],
                'slug' => ['label' => 'Слаг', 'rules' => 'required|alpha_dash|is_unique[posts.slug,id,' . $id . ']'],
                'content' => ['label' => 'Содержание', 'rules' => 'required'],
                'category_id' => ['label' => 'Категория', 'rules' => 'permit_empty|is_natural_no_zero']
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validation;
                return view('themes/admin/function/posts/edit', $data);
            }

            $slug = $this->request->getPost('slug');
            if (empty($slug)) {
                $slug = generate_slug($this->request->getPost('title'));
            }

            $postData = [
                'title' => $this->request->getPost('title'),
                'slug' => $slug,
                'content' => $this->request->getPost('content'),
                'category_id' => $this->request->getPost('category_id') ?: null
            ];

            $suffix = 1;
            $baseSlug = $postData['slug'];
            while ($this->postModel->where('slug', $postData['slug'])->where('id !=', $id)->first()) {
                $postData['slug'] = $baseSlug . '-' . $suffix++;
            }

            if ($this->postModel->update($id, $postData)) {
                session()->setFlashdata('success', 'Пост обновлён.');
                return redirect()->to('/admin/posts');
            }

            session()->setFlashdata('error', 'Ошибка при обновлении.');
        }

        return view('themes/admin/function/posts/edit', $data);
    }

    public function deletePost($id)
    {
        $post = $this->postModel->find($id);
        if (!$post) {
            session()->setFlashdata('error', 'Пост не найден.');
            return redirect()->to('/admin/posts');
        }

        if ($this->postModel->delete($id)) {
            session()->setFlashdata('success', 'Пост удалён.');
        } else {
            session()->setFlashdata('error', 'Ошибка при удалении.');
        }

        return redirect()->to('/admin/posts');
    }

    public function categories()
    {
        $data = [
            'title' => 'Категории | HGS CMS',
            'categories' => $this->categoryModel->findAll()
        ];
        return view('themes/admin/function/categories/list', $data);
    }

    public function createCategory()
    {
        $data = [
            'title' => 'Создать категорию | HGS CMS'
        ];

        if ($this->request->is('post')) {
            $rules = [
                'name' => ['label' => 'Название', 'rules' => 'required|min_length[3]'],
                'slug' => ['label' => 'Слаг', 'rules' => 'required|alpha_dash|is_unique[categories.slug]']
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validation;
                return view('themes/admin/function/categories/create', $data);
            }

            $categoryData = [
                'name' => $this->request->getPost('name'),
                'slug' => $this->request->getPost('slug')
            ];

            if ($this->categoryModel->insert($categoryData)) {
                session()->setFlashdata('success', 'Категория создана.');
                return redirect()->to('/admin/categories');
            }

            session()->setFlashdata('error', 'Ошибка при создании.');
        }

        return view('themes/admin/function/categories/create', $data);
    }

    public function editCategory($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            session()->setFlashdata('error', 'Категория не найдена.');
            return redirect()->to('/admin/categories');
        }

        $data = [
            'title' => 'Редактировать категорию | HGS CMS',
            'category' => $category
        ];

        if ($this->request->is('post')) {
            $rules = [
                'name' => ['label' => 'Название', 'rules' => 'required|min_length[3]'],
                'slug' => ['label' => 'Слаг', 'rules' => 'required|alpha_dash|is_unique[categories.slug,id,' . $id . ']']
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validation;
                return view('themes/admin/function/categories/edit', $data);
            }

            $categoryData = [
                'name' => $this->request->getPost('name'),
                'slug' => $this->request->getPost('slug')
            ];

            if ($this->categoryModel->update($id, $categoryData)) {
                session()->setFlashdata('success', 'Категория обновлена.');
                return redirect()->to('/admin/categories');
            }

            session()->setFlashdata('error', 'Ошибка при обновлении.');
        }

        return view('themes/admin/function/categories/edit', $data);
    }

    public function deleteCategory($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            session()->setFlashdata('error', 'Категория не найдена.');
            return redirect()->to('/admin/categories');
        }

        $this->postModel->where('category_id', $id)->set(['category_id' => null])->update();

        if ($this->categoryModel->delete($id)) {
            session()->setFlashdata('success', 'Категория удалена.');
        } else {
            session()->setFlashdata('error', 'Ошибка при удалении.');
        }

        return redirect()->to('/admin/categories');
    }
}