<?php

namespace App\Controllers;
use App\Models\ArticleModel; 

use App\Entities\ArticleEntity;

class Article extends BaseController
{
    public function __construct()
    {
    }
    public function index() //主頁面，顯示所有文章
    {
        $model = new ArticleModel();
        $data = $model -> findall();
        //dd($data1);
        /*if(count($data)>0) {
        $NewestID = $data[count($data)-1]["id"];
        session()->set("NewestID","$NewestID"); //等等新增文章時可以提供使用者編號
        }*/

        return view("Article/index",["data"=>$data]);
    }
    public function show($id)  //進入編輯頁面
    {
        $model = new ArticleModel();
        $data = $model -> find($id);
        session()->set("id","$id");
        return view("Article/Update",["data"=>$data]);
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
                return redirect() ->to("article/index"); //新增完資料跳回顯示頁面
                
            }
            //驗證失敗跳錯誤訊息，同時跳回顯示頁面
            return redirect() -> to(current_url())
            -> with("errors",$model->errors())
            ->withInput() ;  //WithInput可以記錄使用者輸入過的資料，使用者不須全部重打
        }

    }
    public function Update()
    {
        $id = session() -> get("id");
        $model = new ArticleModel();
        $artical = $model -> find($id); //
        $artical->fill($this->request->getPost()); // fill是Entity裡的Function，會自動轉換得到的資料進obj

        if(!$artical->haschanged()) //資料沒有更動的話使用下面save會error，所以須使用haschanged()先檢查
        {
            return redirect() -> to("article/$id")-> with("UpdateErrors",["資料沒有更動",""]) ;
        }

        if($model->save( $artical )) //驗證、儲存成功
        {
            session() ->set("UpdateSuccess","$id"); //id=寫入資料庫後提醒使用者剛剛修改哪一篇文章
            return redirect() ->to("article"); //新增完資料跳回顯示頁面
        }  
        return redirect() -> to("article/$id")-> with("UpdateErrors",$model->errors())->withInput() ;   
    }
}