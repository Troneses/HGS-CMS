<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Ajax extends Controller
{
    public function slugify()
    {
        if ($this->request->isAJAX()) {
            $title = $this->request->getJSON()->title;
            $slug = generate_slug($title);
            return $this->response->setJSON(['slug' => $slug]);
        }
        return $this->response->setStatusCode(400);
    }
}