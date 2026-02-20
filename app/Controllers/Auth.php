<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function signin()
    {
        echo view('templates/bsb_header');
        echo view('auth/bsb_signin');
        echo view('templates/bsb_footer');
    }

    public function signup()
    {
        echo view('templates/bsb_header');
        echo view('auth/bsb_signup');
        echo view('templates/bsb_footer');
    }

    public function processSignin()
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('user_name', $this->request->getPost('username'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set([
                'user_id'   => $user['user_id'],
                'user_name' => $user['user_name'],
                'logged_in' => true
            ]);
            return redirect()->to('/');
        } 
        else {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }
    }

    public function processSignup()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'user_name'      => 'required|is_unique[user_tbl.user_name]',
            'first_name'     => 'required',
            'last_name'      => 'required',
            'email'          => 'required|valid_email|is_unique[user_tbl.email]',
            'password'       => 'required|min_length[8]',
            'confirm_password' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new \App\Models\UserModel();
        $userModel->save([
            'user_name'  => $this->request->getPost('user_name'),
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/')->with('success', 'Redirecting to homepage...');
    }

    public function signout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}

?>