<?php

namespace App\Controllers;
use App\Models\Post;

class Home extends BaseController
{
    // public function index(): string
    // {
    //     return view('welcome_message');
    // }
    private $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    public function index()
    {
        return view('home/index',[
            "posts" => $this->model->orderBy("created_at", "DESC")->paginate(3),
            "pager" => $this->model->pager,
            "controller" => $this
        ]);
    }
}
