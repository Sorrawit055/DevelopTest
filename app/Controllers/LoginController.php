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

    public function loginAuth()
    {
        $session = session();

        $userModel = new UserModel();

        $username = $this->request->getvar('username');
        $password = $this->request->getvar('password');

        $data = $userModel->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            if ($password == $pass) {
                $ses_data = [
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'username' => $data['username'],
                    'status' => $data['status'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);

                $status = $_SESSION['status'];

                if ($status == "Active") {
                    $session->setFlashdata('success', 'เข้าสู่ระบบ');
                    return redirect()->to('/dashboard');
                }else{
                    $session->setFlashdata('fail', 'Username ปิดใช้งาน');
                    return redirect()->to('/signin');
                }
            } else {
                $session->setFlashdata('fail', 'Passwordไม่ถูกต้อง.');
                return redirect()->to('/signin');
            }
        } else {
            $session->setFlashdata('fail', 'Username ไม่ถูกต้อง.');
            return redirect()->to('/signin');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        if ($session->destroy = TRUE) {
            $session = session();
            return redirect()->to('/logout_message');
        }
    }
    public function logout_message()
    {
        $session = session();
        $session->setFlashdata('success', 'ออกจากระบบ');
        return redirect()->to('/signin');

    }

}
