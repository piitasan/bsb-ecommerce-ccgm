<?php

namespace App\Models;

use CodeIgniter\Model;

class WishlistModel extends Model
{
    protected $table = 'wishlist_tbl';
    protected $primaryKey = 'wishlist_id';
    protected $allowedFields = ['user_id', 'product_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;

    // Get wishlist items with product details for a user
    public function getUserWishlist($userId)
    {
        return $this->select('wishlist_tbl.*, product_tbl.*')
                    ->join('product_tbl', 'product_tbl.product_id = wishlist_tbl.product_id')
                    ->where('wishlist_tbl.user_id', $userId)
                    ->findAll();
    }

    // Add item to wishlist
    public function addToWishlist($userId, $productId)
    {
        // Check if already exists
        $existing = $this->where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();
        
        if ($existing) {
            return false; // Already in wishlist
        }

        return $this->insert([
            'user_id' => $userId,
            'product_id' => $productId
        ]);
    }

    // Remove item from wishlist
    public function removeFromWishlist($userId, $productId)
    {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->delete();
    }

    // Check if product is in user's wishlist
    public function isInWishlist($userId, $productId)
    {
        return $this->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->first() !== null;
    }

    // Get wishlist count for user
    public function getWishlistCount($userId)
    {
        return $this->where('user_id', $userId)->countAllResults();
    }
}