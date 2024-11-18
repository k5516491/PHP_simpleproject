<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Password extends BaseController
{

    public function show()
    {
        return view("Auth/Password");
    }
    public function Update()
    {
        $validationRules = [
            "password"=> [
                "label"=> "password",
                "rules"=> "required"
            ],
            "password_again"=> [
                "label"=> "password_again",
                "rules"=> "required|matches[password]"
            ]
        ];
        //-------------------------------------------------------------
        //自訂的驗證錯誤訊息
        $validationMessages = [
            'password'=> 
            [
                'required'=> '新密碼不能為空'
            ],
            'password_again'=> 
            [
                'required'=> '再次輸入新密碼不能為空',
                'matches'=> '兩次輸入密碼不吻合'
            ]
        ];

        if (! $this->validate($validationRules, $validationMessages) )  //驗證失敗，秀錯誤訊息
        {
            //驗證失敗跳錯誤訊息
            return redirect() -> to(current_url())
            -> with("SetPasswordErrors",$this->validator->getErrors())
            ->withInput() ;  //WithInput可以記錄使用者輸入過的資料，使用者不須全部重打
        }
        
        $user = auth()->user();
        $user->password = $this->request->getPost("password");
        $model = new UserModel();
        $model->save($user);
        session()->removeTempdata("magicLogin"); //session需reset。
        session() ->set("ChangePWSuccess","修改成功，請於下次登入使用新密碼"); //id=寫入資料庫後提醒使用者剛剛修改哪一篇文章
        return redirect() ->to("login"); //新增完資料跳回顯示頁面

        //return view("Auth/Password");
    }
}
