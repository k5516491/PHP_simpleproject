<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyUserIDToArticleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("article", [ //先在Article表添加一個欄位叫做User_ID
            "user_id" => [
                "type" => "int" ,
                "null" => false, 
                "unsigned" => true,
                "constraint" => 11
            ]
        ]);
        //--------------- 插入FK之前 先把users_id通通設成一個值，不然null會報錯
        $sql = "select id from users limit 1";
        $result = $this->db->query($sql)->getResult(); //隨便得到一筆id
        if($result)
        {
            $sql  = "Update article set user_id = {$result[0]->id} ";
            $this->db->query($sql);
        }
        //---------------------------------

        $this->forge->addForeignKey
            ("user_id"/*Child column*/, "users"/*Father Table */, "id"/*Father column */,
            "CASCADE"/*onUpdate*/,"CASCADE"/*onDelete*/,
            "article-usersid_FK_users-id"/*FK_name*/);

        $this->forge->processIndexes("article");
    }

    public function down()
    {
        $this -> forge-> dropForeignKey("article", "article-usersid_FK_users-id");
        $this->forge->dropColumn("article","user_id");
    }
}
