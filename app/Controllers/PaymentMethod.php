<?php

namespace App\Controllers;

use App\Models\PaymentMethodModel;

class PaymentMethod extends BaseController
{
    protected $paymentMethodModel;

    public function __construct()
    {
        $this->paymentMethodModel = new PaymentMethodModel();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/bsb_signin')->with('error', 'Please login to access this page');
        }

        $userId = session()->get('user_id');
        
        $data['payment_methods'] = $this->paymentMethodModel->getUserPaymentMethods($userId);
        $data['title'] = 'Payment Methods';

        return view('templates/header', $data)
            . view('bsb_payment_methods', $data)
            . view('templates/footer');
    }

    // Add payment method
    public function add()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/bsb_signin');
        }

        $userId = session()->get('user_id');
        $methodType = $this->request->getPost('method_type');

        $paymentData = [
            'user_id' => $userId,
            'method_type' => $methodType,
            'is_default' => $this->request->getPost('is_default') ? 1 : 0
        ];

        // Add credit card specific fields
        if ($methodType === 'credit_card') {
            $paymentData['card_number'] = $this->request->getPost('card_number');
            $paymentData['card_name'] = $this->request->getPost('card_name');
            $paymentData['expiry_date'] = $this->request->getPost('expiry_date');
            $paymentData['cvv'] = $this->request->getPost('cvv');
        }

        if ($this->paymentMethodModel->addPaymentMethod($paymentData)) {
            return redirect()->to('/payment-methods')->with('success', 'Payment method added successfully');
        } else {
            return redirect()->to('/payment-methods')->with('error', 'Failed to add payment method');
        }
    }

    // Delete payment method
    public function delete($paymentMethodId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/bsb_signin');
        }

        $userId = session()->get('user_id');
        
        if ($this->paymentMethodModel->deletePaymentMethod($userId, $paymentMethodId)) {
            return redirect()->to('/payment-methods')->with('success', 'Payment method deleted');
        } else {
            return redirect()->to('/payment-methods')->with('error', 'Failed to delete payment method');
        }
    }

    // Set default payment method
    public function setDefault($paymentMethodId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/bsb_signin');
        }

        $userId = session()->get('user_id');
        
        if ($this->paymentMethodModel->setDefaultPaymentMethod($userId, $paymentMethodId)) {
            return redirect()->to('/payment-methods')->with('success', 'Default payment method updated');
        } else {
            return redirect()->to('/payment-methods')->with('error', 'Failed to update default payment method');
        }
    }
}