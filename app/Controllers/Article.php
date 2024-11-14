<?php

namespace App\Controllers;
use App\Models\ArticleModel; 

class Article extends BaseController
{
    public function __construct()
    {
    }
    public function index()
    {
    }
    public function show() //顯示所有文章 預設routing為此function
    {
        $model = new ArticleModel();
        $data = $model -> findall();

        return view("Article/index",["data"=>$data]);
    }
    public function create() //新增一篇文章
    {
        $model = new ArticleModel();
        echo view("Article/Create") ;

        if($this->request->getPost() != null) //按按鈕才判斷
        {
            $aut = $model->insert($this->request->getPost()); //insert Function，帶驗證
            if($aut) //驗證成功，寫入資料庫後提醒使用者剛剛輸入哪一筆資料
            {
                $data = $this->request->getPost("Title");
                session() ->set("success","$data");
                return redirect() ->to("Article/show"); //新增完資料跳回顯示頁面
            }  
            else
            {
                return redirect() -> back() -> with("errors",$model->errors()); //跳錯誤訊息，同時跳回顯示頁面
            }    
        }

    }
}