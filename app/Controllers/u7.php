<?php
namespace App\Controllers;
require_once(dirname(dirname(__file__)).'\bootstrap.php');

class u7 extends \CodeIgniter\Controller
{ 
    public $session ;
    public function __construct()
    {
        //呼叫modeling這個Function來初始model/StudentModel.php
        $this->StudentModel = $this -> modeling(model: "StudentModel");
        helper("form"); //呼叫form_helper
        $this -> session = \config\Services::session(); //使用session
    }
    public function index ()
    {
        //$_POST = http回傳的值
        
        $T_Student = $this->StudentModel-> get_StudentList(); //這裡已經從資料庫抓到資料
        $data = [
            'studenttttt' => $T_Student
        ];
        echo view('DB_Connect' , $data) ;
        if($this ->request->getMethod() == 'POST') //按下按鈕http回傳資料=post
        {  
            $NewStudent = $this -> request-> getVar("studentname"); //從網頁InputBox回傳新生名字
            if ($NewStudent== null) { //輸入為空字串，直接跳訊息return
                $this -> session ->setTempdata("error","請輸入新生姓名",1);
                return redirect() ->to(current_url());
            }
            $Check = $this->StudentModel-> CheckDulpicate($NewStudent) ; //進資料庫查看是否重複
            if(count($Check)>0) //輸入重複資料，顯示提示訊息
            {
                $this -> session ->setTempdata("errorD","學生:$NewStudent 重複輸入，請再次檢查",1);
                return redirect() ->to(current_url());
            }
            else //有效的新資料，可以寫進資料庫
            {
            $this -> StudentModel -> New_Student($NewStudent);
            $this -> session ->setTempdata("success","新生: $NewStudent 已成功輸入",1);
            return redirect() ->to(current_url());
            }
        }

        //$Check = $this->StudentModel-> CheckDulpicate($NewStudent) ;
        /*if(count($Check)>0) //輸入重複資料，顯示提示訊息
        {
            echo "請輸入新生資料";
            header("Location: http://localhost/u8/u7"); //直接F5
            exit();
        }
        */

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