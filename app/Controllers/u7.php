<?php
namespace App\Controllers;
require_once(dirname(dirname(__file__)).'\bootstrap.php');

class u7 extends \CodeIgniter\Controller
{ 
    public function __construct()
    {
        //呼叫modeling這個Function來初始model/StudentModel.php
        $this->StudentModel = $this -> modeling(model: "StudentModel");
        //呼叫form_helper
        helper("form");
    }
    public function index ()
    {
        $T_Student = $this->StudentModel-> get_StudentList(); //這裡已經從資料庫抓到資料
        $data = [
            'studenttttt' => $T_Student
        ];
        echo view('DB_Connect' , $data) ;
        $NewStudent = $this -> request-> getVar("studentname"); //從網頁新增按鈕觸發回傳新生名字
        $Check = $this->StudentModel-> CheckDulpicate($NewStudent) ;
        if (count($Check)>0) { //輸入重複學生
            echo "已經有重複的學生資料";
            header("Location: http://localhost/u8/u7"); //直接F5
        }
        else if($NewStudent!= null) //輸入不為空，寫入新生至資料庫
        {
            $this -> StudentModel -> New_Student($NewStudent);
            header("Location: http://localhost/u8/u7"); //直接F5
            exit();
        }
        else //輸入為空
        {
            echo "請輸入新生資料";
        }

        /*最初的資料庫寫法
        //------------------------------------------------------
        $db = \Config\Database::connect() ;//連結資料庫
        $query = $db -> query ('select * from classroom')  ;
        $result = $query -> getResult();

        echo "下面是班級表的JSON :<br>" ;
        // 單純的json_encode顯示中文會產生亂碼 ，後面需加flags : JSON_UNESCAPED_UNICODE 
        echo  json_encode($result, JSON_UNESCAPED_UNICODE) ;

        echo "<br>下面是學生表的JSON :<br>" ;
        $query = $db -> query ('select * from student')-> getResultArray() ;
        echo  json_encode($query, JSON_UNESCAPED_UNICODE) ;
        //--------------------------------------------------------
        *///最初的資料庫寫法

        //可以get到?url=後的字串
        if (isset($_GET['url']))
        {
            echo $_GET['url'];
        }
        
    }
    public function modeling($model) //require model
    {
        require_once appRoot.'\Models/'.$model. '.php';
        return new $model ;
    }
    function randomstring ()  //自製驗證碼
    {
        //前面10位數字先打散後面串接26個打散的字母
        return substr(str_shuffle('1234567890').str_shuffle('abcdefghijklmnopqrstuvwxyz'),8,6) ;
    }
    public function create()
    {
        echo'u7 create';
    }

}