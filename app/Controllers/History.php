<?php

namespace App\Controllers;

class History extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/bsb_signin');
        }

        // Get user's order history
        $orderModel = new \App\Models\OrderModel();
        $data['orders'] = $orderModel->where('user_id', session()->get('user_id'))->findAll();

        echo view('templates/bsb_header');
        echo view('bsb_history', $data);
        echo view('templates/bsb_footer');
    }
}