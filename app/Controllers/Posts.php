<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PostModel;

class Posts extends Controller
{
    protected $postModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Посты | HGS CMS',
            'posts' => $this->postModel->select('posts.*, users.username, categories.name as category_name')
                ->join('users', 'users.id = posts.user_id')
                ->join('categories', 'categories.id = posts.category_id', 'left')
                ->findAll()
        ];
        return view('themes/public/function/posts/list', $data);
    }

    public function view($slug)
    {
        $post = $this->postModel->select('posts.*, users.username, categories.name as category_name')
            ->join('users', 'users.id = posts.user_id')
            ->join('categories', 'categories.id = posts.category_id', 'left')
            ->where('posts.slug', $slug)
            ->first();

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => esc($post['title']) . ' | HGS CMS',
            'post' => $post
        ];
        return view('themes/public/function/posts/view', $data);
    }
}