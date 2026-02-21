<?php

namespace App\Controllers;

use App\Models\WishlistModel;
use App\Models\ProductModel;

class Wishlist extends BaseController
{
    protected $wishlistModel;
    protected $productModel;

    public function __construct()
    {
        $this->wishlistModel = new WishlistModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signin')->with('error', 'Please login to view wishlist');
        }

        $userId = session()->get('user_id');
        
        // Get wishlist items with product details
        $data['wishlist_items'] = $this->wishlistModel->getUserWishlist($userId);
        $data['title'] = 'My Wishlist';

        return view('templates/header', $data)
            . view('bsb_wishlist', $data)
            . view('templates/footer');
    }

    // Add to wishlist
    public function add($productId)
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $userId = session()->get('user_id');
        
        // Verify product exists
        $product = $this->productModel->find($productId);
        if (!$product) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        $result = $this->wishlistModel->addToWishlist($userId, $productId);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Added to wishlist'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Already in wishlist'
            ]);
        }
    }

    // Remove from wishlist
    public function remove($productId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/signin');
        }

        $userId = session()->get('user_id');
        $this->wishlistModel->removeFromWishlist($userId, $productId);

        return redirect()->to('/wishlist')->with('success', 'Item removed from wishlist');
    }

    // Toggle wishlist (AJAX)
    public function toggle()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $productId = $this->request->getPost('product_id');
        $userId = session()->get('user_id');

        $isInWishlist = $this->wishlistModel->isInWishlist($userId, $productId);

        if ($isInWishlist) {
            $this->wishlistModel->removeFromWishlist($userId, $productId);
            $message = 'Removed from wishlist';
            $action = 'removed';
        } else {
            $this->wishlistModel->addToWishlist($userId, $productId);
            $message = 'Added to wishlist';
            $action = 'added';
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => $message,
            'action' => $action
        ]);
    }
}