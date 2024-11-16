<?php

namespace App\Controllers;
use App\Models\ArticleModel; 
//use codeigniter\Exceptions\PageNotFoundException;
use App\Entities\ArticleEntity;
use CodeIgniter\Exceptions\PageNotFoundException;

class Article extends BaseController
{
    private ArticleModel $model;
    public function __construct()
    {
        $this->model = new ArticleModel();
    }
    public function index() //主頁面，顯示所有文章
    {
        $data = $this->model-> findall();
        //dd($data1);
        /*if(count($data)>0) {
        $NewestID = $data[count($data)-1]["id"];
        session()->set("NewestID","$NewestID"); //等等新增文章時可以提供使用者編號
        }*/

        return view("Article/index",["data"=>$data]);
    }
    public function show($id)  //進入編輯頁面
    {
        $data = $this->Showor404($id);
        session()->set("id","$id");
        return view("Article/Update",["data"=>$data]);
    }
    public function create() //新增一篇文章
    {
        
        echo view("Article/Create") ;
        if($this->request->getPost() != null) //按按鈕才判斷
        {
            $aut = $this->model->insert($this->request->getPost()); //insert Function，帶驗證
            if($aut) //驗證成功，寫入資料庫後提醒使用者剛剛輸入哪一筆資料
            {
                $data = $this->request->getPost("Title");
                session() ->set("success","$data");
                return redirect() ->to("article/index"); //新增完資料跳回顯示頁面
                
            }
            //驗證失敗跳錯誤訊息，同時跳回顯示頁面
            return redirect() -> to(current_url())
            -> with("errors",$this->model->errors())
            ->withInput() ;  //WithInput可以記錄使用者輸入過的資料，使用者不須全部重打
        }

    }
    public function Update() //修改操作+刪除判斷
    {
        $id = session() -> get("id");
        $artical = $this->Showor404($id);

        if(isset(($_POST["But_Delete"])))
        {
            //return view("Article/Delete",["data"=>$artical]);
            session() ->set("DeletedID","$id"); //顯示欲刪除的id
            return redirect() -> to("article/delete");
        }
        
        $artical->fill($this->request->getPost());// fill是Entity裡的Function，會自動轉換得到的資料進obj
        if(!$artical->haschanged()) //資料沒有更動的話使用下面save會error，所以須使用haschanged()先檢查
        {
            return redirect() -> to("article/Update/$id")-> with("UpdateErrors",["資料沒有更動",""]) ;
        }

        if($this->model->save( $artical )) //驗證、儲存成功
        {
            session() ->set("UpdateSuccess","$id"); //id=寫入資料庫後提醒使用者剛剛修改哪一篇文章
            return redirect() ->to("article"); //新增完資料跳回顯示頁面
        }  
        return redirect() -> to("article/Update/$id")-> with("UpdateErrors",$this->model->errors())->withInput() ;   
    }
    public function delete()
    {
        echo view("Article/Delete") ;
        $id = session() -> get("id");
        if(isset(($_POST["confirm"]))) //按下確認
        {
            $this -> model->delete($id);
            session() ->set("DeleteSuccess","$id"); //id=寫入資料庫後提醒使用者剛剛修改哪一篇文章
            return redirect() ->to("article"); //新增完資料跳回顯示頁面
        }
        else if (isset(($_POST["cancel"])))
        {
            return redirect() -> to("article/Update/$id");
        }
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