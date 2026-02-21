<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table = 'payment_methods_tbl';
    protected $primaryKey = 'payment_method_id';
    protected $allowedFields = [
        'user_id', 'method_type', 'card_number', 'card_name', 
        'expiry_date', 'cvv', 'is_default'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get all payment methods for a user
    public function getUserPaymentMethods($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('is_default', 'DESC')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    // Add payment method
    public function addPaymentMethod($data)
    {
        // If this is set as default, unset other defaults
        if (isset($data['is_default']) && $data['is_default'] == 1) {
            $this->where('user_id', $data['user_id'])
                 ->set(['is_default' => 0])
                 ->update();
        }

        // Encrypt sensitive data (basic encryption - in production use proper encryption)
        if (isset($data['card_number'])) {
            $data['card_number'] = $this->encryptData($data['card_number']);
        }
        if (isset($data['cvv'])) {
            $data['cvv'] = $this->encryptData($data['cvv']);
        }

        return $this->insert($data);
    }

    // Delete payment method
    public function deletePaymentMethod($userId, $paymentMethodId)
    {
        return $this->where('user_id', $userId)
                    ->where('payment_method_id', $paymentMethodId)
                    ->delete();
    }

    // Set default payment method
    public function setDefaultPaymentMethod($userId, $paymentMethodId)
    {
        // Unset all defaults
        $this->where('user_id', $userId)
             ->set(['is_default' => 0])
             ->update();

        // Set new default
        return $this->where('user_id', $userId)
                    ->where('payment_method_id', $paymentMethodId)
                    ->set(['is_default' => 1])
                    ->update();
    }

    // Basic encryption (use proper encryption in production)
    private function encryptData($data)
    {
        return base64_encode($data);
    }

    // Basic decryption
    public function decryptData($data)
    {
        return base64_decode($data);
    }

    // Get masked card number
    public function getMaskedCardNumber($cardNumber)
    {
        $decrypted = $this->decryptData($cardNumber);
        return '**** **** **** ' . substr($decrypted, -4);
    }
}