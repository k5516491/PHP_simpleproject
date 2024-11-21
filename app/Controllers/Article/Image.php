<?php

namespace App\Controllers\Article;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Entities\Article;
class Image extends BaseController
{
    private ArticleModel $model ;

    public function __construct()
    {
        $this->model = new ArticleModel();
    }
    public function new($id)
    {
        $article = $this->Showor404($id);
        return view("Article/Image/new",[
            "article"=> $article
        ]);
    }


    public function create($id)
    {
        $article = $this->Showor404($id);
        $file = $this->request->getFile("image");
        dd($file);
    }

    private function Showor404($id)
    {
        $artical = $this->model -> find($id);
        if($artical===null) {
            // App\Views\errors\html\error_404.php
            throw new PageNotFoundException("此文章編號:$id"."不存在，請再次確認");
        }
        return $artical ;
    }
}
