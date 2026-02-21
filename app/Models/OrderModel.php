<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'order_tbl';
    protected $primaryKey = 'order_id';

    protected $allowedFields = [
        'user_id', 'total_price', 'status', 'payment_method'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'order_date';
    protected $updatedField  = 'updated_at';
    
    // Get order history with items for a specific user
    public function getOrderHistory($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('order_date', 'DESC')
                    ->findAll();
    }
    
    // Get order with all its items
    public function getOrderWithItems($orderId)
    {
        $orderItemModel = new \App\Models\OrderItemModel();
        
        $order = $this->find($orderId);
        if ($order) {
            $order['items'] = $orderItemModel->getOrderItems($orderId);
        }
        
        return $order;
    }
} 