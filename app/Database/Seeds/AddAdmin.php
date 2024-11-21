<?php //添加一筆資料Admin到資料庫的過程

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;
use App\Models\UserModel;
class AddAdmin extends Seeder
{
    public function run()
    {
        $user = new User(
            [
                "email"=> "admin@u7.com",
                "password"=> "123",
                "first_name"=> "Admin Yuchi",
            ]
        );
        $model = new UserModel;
        $model->save($user);
        $user = $model->findById($model->getInsertID()); //user變數裡的資料不會自動更新，需自行進資料庫把最新一筆(getInsertID)撈出來
        $user->activate(); //電子信箱認證
        $user->addGroup("user","admin");

    }
}
