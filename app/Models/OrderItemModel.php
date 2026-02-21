<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table      = 'order_items_tbl';
    protected $primaryKey = 'order_item_id';

    protected $allowedFields = [
        'order_id', 'product_id', 'product_name', 'product_category', 
        'price', 'quantity', 'subtotal'
    ];

    protected $useTimestamps = false;
    
    // Get all items for a specific order
    public function getOrderItems($orderId)
    {
        return $this->where('order_id', $orderId)->findAll();
    }
}
