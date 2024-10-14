<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\Post;

class Posts extends BaseController
{
    private $model;
    public function __construct()
    {
        $this->model = new Post();
    }

    public function index()
    {
        $posts = $this->model->findAll();
        return view('posts/index', [
            "posts" => $posts,
            "controller" => $this
        ]);
    }

    public function show($id)
    {
        $post = $this->model->find($id);
        if (!$post) {
            throw PageNotFoundException::forPageNotFound("Article $id not found !");
        }
        return view('posts/show', [
            "post" => $post,
            "controller" => $this
        ]);
    }

    public function create()
    {
        return view('posts/create');
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|max_length[100]',
            'description' => 'required'
        ]);

        if ($this->validator->getErrors()) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $data = $this->request->getPost();

        // Prepare data
        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            // 'post_image' => $this->request->getPost('image'), // Uncomment if needed
        ];

        // $post = new Post($this->request->getPost());
        // $data = $this->model->insert($post);
        if ($this->model->insert($data)) {
            return redirect()->to("/posts")->with("success", "Article added");
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }

        // if ($data) {
        //     return redirect()->to("/posts")->with("success", "Article added");
        // } else {
        //     return redirect()->back()
        //         ->with('errors', $this->model->errors())
        //         ->withInput();
        // }
        // log_message('error', print_r($this->model->errors(), true));
    }

    public function edit($id)
    {
        $post = $this->model->find($id);

        if ($post) {
            return view('posts/edit', [
                "post" => $post,
            ]);
        }
        return redirect()->to('/');
    }

    public function update($id)
    {
        $post = $this->model->find($id);
        $post->fill($this->request->getPost());
        if ($post) {
            if ($post->hasChanged('title') || $post->hasChanged('description')) {
                if ($this->model->save($post)) {
                    return redirect()->to("/posts")->with("success", "Article updated");
                } else {
                    return redirect()->back()
                        ->with('errors', $this->model->errors())
                        ->withInput();
                }
            } else {
                return redirect()->back()
                    ->with('error', "Nothing changed !")
                    ->withInput();
            }
        } else {
            return redirect()->to("/");
        }
    }

    public function delete($id)
    {
        $post = $this->model->find($id);

        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Article $id not found !");
        }


        if ($post) {
            $this->model->delete($id);
            return redirect()->to("/posts")->with("success", "Article deleted");
        }
        return redirect()->to("/");
    }
}
