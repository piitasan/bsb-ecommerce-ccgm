<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('templates/bsb_header');
        echo view('bsb_home');
        echo view('templates/bsb_footer');
    }
}

?>