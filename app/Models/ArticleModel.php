<?php
namespace App\Models;

use CodeIgniter\Model;
// Official Doc: https://codeigniter.com/user_guide/models/model.html
class ArticleModel extends Model
{
    protected $table = "article"; //代表使用Article這張表
    protected $useTimestamps = true;
    protected $returnType = \App\Entities\ArticleEntity::class; //本來的ArticleModel的ReturnType從model的Array轉為entity的物件

    //-----
    //從Controller要使用到Model的insert、Update需添加進$allowedFields，
    ////對應View的Name、資料表的欄位名，有分大小寫!
    protected $allowedFields = ["Title","Content"]; 
    //-------------------------------------------------------------
    //-----輸入欄位的驗證規則
    protected $validationRules =[
        "Title" => "required|Max_length[128]",
        "Content" => "required",
    ];
    //-------------------------------------------------------------
    //-----自訂的驗證錯誤訊息
    protected $validationMessages = [
        'Title'=> 
        [
            'required'=> '標題不能為空'
        ],
        'Content'=> 
        [
            'required'=> '內容不能為空'
        ]
    ];
    //-------------------------------------------------------------
    
    //-----Model Event 有insert、update、delete 這一部分詳見{102} 
    protected $beforeInsert = ["setUserID"];
    protected function setUserID(array $data)
    {
        $data["data"]["user_id"] = auth()->user()->id;
        return $data;
    }
    //-------------------------------------------------------------
}