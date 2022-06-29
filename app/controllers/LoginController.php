<?php

namespace App\Controllers;

use App\Models\User;

class LoginController
{
    public function index()
    {
        return view('auth.login');
    }

    public function addForm()
    {
        // return view('auth.add-form');
        include_once './app/views/auth/add-form.php';
    }

    public function login()
    {
        $email = isset($_POST['inputEmail']) ? $_POST['inputEmail'] : "";
        $pass = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : "";

        $model = User::where('email', $email)->first();

        if ($model) {
            if ($model && password_verify($pass,$model->password)) {
                $_SESSION['auth'] = [
                    "id" => $model->id,
                    "name" => $model->name,
                    "email" => $model->email,
                    "role_id" => $model->role_id
                ];
                if ($model->role_id == 1) {
                    header('location: ' . BASE_URL . 'mon-hoc');
                    die;
                } else {
                    header('location: ' . BASE_URL . 'sv');
                    die;
                }
            } else {
                header('location: ' . BASE_URL . 'login?msg=Mật khẩu không đúng!');
                die;
            }
        } else {
            header('location: ' . BASE_URL . 'login?msg=Tài khoản không tồn tại!');
            die;
        }

        return view('auth.login');
    }

    public function saveAdd()
    {
        $pass = $_POST['password'];
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $repeatpass = $_POST['user-repeatpass'];
      
        if (!$_POST['name']) {
            header('location: ' . BASE_URL . 'login/tao-moi?msg=Họ tên không được trống!');
                die;
        } elseif (!$_POST['email']) {
            header('location: ' . BASE_URL . 'login/tao-moi?msg=Email không được trống!');
                die;
        } elseif (!$password) {
          
            header('location: ' . BASE_URL . 'login/tao-moi?msg=Password không được trống!');
                die;
        } elseif ($repeatpass != $pass) {

            header('location: ' . BASE_URL . 'login/tao-moi?msg=Xác nhận mật khẩu không đúng!!');
                die;
        }
            // User::create([
            //    'name'=>$_POST['name'],
            //    'email'=>$_POST['email'],
            //    'password'=>$password
            // ]);
            $user = User::create($_POST);
            $user->password = $password;
            $user->save();
            header('location: ' . BASE_URL . 'login?msg=Đăng ký thành công!');
            die;

    }
}
