<?php
namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = "article"; //代表使用Article這張表

    //-------------------------------------------------------------
    protected $allowedFields = ["Title","Content"]; 
    //從Controller要使用到Model的insert、Update需添加進$allowedFields
    //，對應View的Name、資料表的欄位名，有分大小寫!
    //-------------------------------------------------------------
    protected $validationRules =[
        "Title" => "required|Max_length[128]",
        "Content" => "required",
    ];
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

}