<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NewColumnToUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn("users"/* <TABLE> */,
        [
            "first_name"/* <New Column> */=>
                    [
                    "type"=> "varchar",
                    "constraint"=> 64,
                    "null"=> false,
                    ]
            ]);
    }

    public function down()
    {
        $this->forge->dropColumn("users","first_name");
    }
}
