<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTimestampToArticleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("article",[
            "created_at" => [
                "type" => "DATETIME"
            ],
            "updated_at" =>[
                "type" => "DATETIME"
            ]
            ]);
        $this->forge->addKey("created_at");
        $this->forge->processIndexes("article");
    }

    public function down()
    {
        $this->forge->dropColumn("article",["created_at", "updated_at"]);
    }
}
