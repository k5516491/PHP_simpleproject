<?php

namespace App\Controllers;
use App\Models\ArticleModel; 
//use codeigniter\Exceptions\PageNotFoundException;
use App\Entities\ArticleEntity;
use CodeIgniter\Exceptions\PageNotFoundException;
use RuntimeException;
use finfo;
class Article extends BaseController
{
    private ArticleModel $model;
    public function __construct()
    {
        $this->model = new ArticleModel();
    }
    public function index() //主頁面，顯示所有文章
    {
        //$this -> sendTestMail();  //測試Mail是否正常
        if (session("magicLogin"))
        {
            return redirect() -> to("set-password")-> with("UpdatePWBy_MagicLogin","請變更為新密碼") ; 
        }
        $data = $this->model-> paginate(3);
        return view("Article/index",["data"=>$data, "pager"=>$this->model->pager] );
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
        if(isset(($_POST["But_Image"])))
        {
            session() ->set("ImageID","$id"); //顯示欲新增圖片的id
            return redirect() -> to("article/Image");
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
    public function delete() //執行刪除
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
    public function Image() //顯示圖片上傳頁面
    {
        echo view("Article/Image/new") ;
        $id = session() -> get("id");
        
    }
    public function ImageCreate() //圖片上傳
    {
        //echo view("Article/Image/new") ;
        $id = session() -> get("id");
        $article = $this->Showor404($id);
        $file = $this->request->getFile("image");
        if( ! $file->isValid()) {
            $error_code = $file->getError();
            if ( $error_code === UPLOAD_ERR_NO_FILE) {
                return redirect() -> back() -> with("errors",["尚未選取檔案"]) ;
        }
        throw new RuntimeException($file->getErrorString(). " ". $error_code );
        
        }
        if(! in_array($file->getMimeType(), ["image/png", "image/jpg", "image/jpeg"])) { //檢查檔案規格
            return redirect() -> back() -> with("errors",["檔案不是規定的圖檔:jpg、jpeg、PNG"]) ;
        }
        if($file->getSizeByUnit("mb")>2) {//檢查檔案大小
            return redirect() -> back() -> with("errors",["檔案太大了"]) ;
        }
        //dd($file->getRealPath()); //可以看上傳的圖片暫存位置
        $path = $file->store("articleImage"); //store裡面的括號是存放圖片資料夾名字，沒有的話會自動建立
        $article->image = $file->getName();
        $this->model->protect(false)->save($article);
        return redirect() -> to("article/Update/$id") -> with("ImageUploadsuccess","圖片上傳成功") ;
    }
    public function ImageDelete() {
        $id = session() -> get("id");
        $article = $this->Showor404($id);
        $path = WRITEPATH . "uploads/articleImage/". $article->image ;
        if( is_file( $path ) ) {
            unlink( $path );
        }
        $article->image = NULL ;
        $this->model->protect(false)->save($article);
        return redirect() -> to("article/Update/$id") -> with("ImageDeletesuccess","圖片刪除成功") ;
    }
    public function showImage()
    {
        $id = session() -> get("id");
        $article = $this->Showor404($id);
        if($article->image) {
            $path = WRITEPATH . "uploads/articleImage/". $article->image ;
            $finfo = new finfo(FILEINFO_MIME);
            $type = $finfo ->file($path);

            header("Content-Type: $type");
            header("Content-Length: ".filesize($path));
            readfile($path);
            exit; //剛剛有讀檔這邊要close
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
    private function sendTestMail()
    {
        $email  = \Config\Services::email();
        $email ->setTo("a250031452@yahoo.com.tw");
        $email -> setsubject("Test from Ci4");
        $email -> setMessage("Hello from u7_Ci_SMTP");
        if ($email -> send()) 
        {
            echo "mail sent" ;
        }
        else
        {
            echo "Mail nooooooooooooooooooo sent";
        }
    }
}