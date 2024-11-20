<?php

namespace Admin\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
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
}
