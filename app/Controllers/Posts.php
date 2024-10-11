<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\Post;
// use App\Entities\Post;

class Posts extends BaseController
{
    private $model;
    public function __construct()
    {
        $this->model = new Post();
    }

    public function index()
    {
        return view('home/index',[
            "posts" => $this->model->orderBy("created_at", "DESC"),
            // "pager" => $this->model->pager,
            "controller" => $this
        ]);
    }

    public function show($id) {
        $post = $this->model->find($id);
        if(!$post) {
            throw PageNotFoundException::forPageNotFound("Article $id not found !");
        }
        return view('posts/show',[
            "post" => $post,
            "controller" => $this
        ]);
    }

    public function create(){
        return view('posts/create');
    }

    public function store() {
        $post = new Post($this->request->getPost());
        $data = $this->model->insert($post);

        if ($data) {
            return redirect()->to("/posts")->with("success", "Article added");
        } else {
            return redirect()->back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function edit($id) {
        $post = $this->model->find($id);

        if($post) {
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
