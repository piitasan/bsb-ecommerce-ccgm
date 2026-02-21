<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/bsb_signin');
        }

        echo view('templates/bsb_header');
        echo view('bsb_profile');
        echo view('templates/bsb_footer');
    }
}

?>