<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table      = 'cart_tbl';
    protected $primaryKey = 'cart_id';

    protected $allowedFields = [
        'user_id', 'product_id', 'quantity'
    ];

    protected $useTimestamps = false;
    
    // Get cart items with product details for a specific user
    public function getCartWithProducts($userId)
    {
        return $this->select('cart_tbl.*, product_tbl.product_name, product_tbl.product_category, product_tbl.price, product_tbl.image_url')
                    ->join('product_tbl', 'product_tbl.product_id = cart_tbl.product_id')
                    ->where('cart_tbl.user_id', $userId)
                    ->findAll();
    }
    
    // Calculate total price for user's cart
    public function getCartTotal($userId)
    {
        $items = $this->getCartWithProducts($userId);
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
