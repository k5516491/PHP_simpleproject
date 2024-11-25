<?php

namespace Admin\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\UserModel;
class User extends BaseController
{
    private UserModel $model;
    private $temp_ViewPath ;
    public function __construct()
    {
        $this->model = new UserModel();
        $this->temp_ViewPath = "Admin\Views";
    }
    public function index()
    {
        return view($this->temp_ViewPath."\Users\index", ["User" => $this->model->orderBy("created_at")->paginate()]);
    }
    public function show($id)
    {
        $data = $this->FindOr404($id);
        return view($this->temp_ViewPath."\Users\show", ["User" => $data]);
    }
    public function group($id)
    {
        $data = $this->FindOr404($id);

        if($this->request->getPost() != null) //按按鈕才判斷
        {
            $group = $this->request->getPost("group" );
            $data->syncGroups(...$group);
            return redirect()->to("admin/user/$id")->with("message","身分已儲存");
        }
        return view($this->temp_ViewPath."\Users\group", ["User" => $data]);

    }

    public function FindOr404($id)
    {
        $user = $this->model -> find($id);
        if($user===null) {
            // App\Views\errors\html\error_404.php
            throw new PageNotFoundException("此編號使用者:$id"."不存在，請再次確認");
        }
        return $user ;
    }
}
