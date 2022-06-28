<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        echo view('component/header');
        return view('login');
    }

 
}
