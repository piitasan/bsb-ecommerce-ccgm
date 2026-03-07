<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\ProductModel;

class Cart extends BaseController
{
    protected $cartModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/bsb_signin')->with('error', 'Please login to view cart');
        }

        $userId = session()->get('user_id');
        
        // Get cart items with product details
        $data['cart_items'] = $this->cartModel->getCartWithProducts($userId);
        $data['cart_total'] = $this->cartModel->getCartTotal($userId);
        $data['title'] = 'Shopping Cart';

        return view('templates/bsb_header', $data)
            . view('bsb_cart', $data)
            . view('templates/bsb_footer');
    }

    // Add to cart
    public function add()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $userId = session()->get('user_id');
        $productId = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity') ?? 1;
        
        // Verify product exists
        $product = $this->productModel->find($productId);
        if (!$product) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }

        // Check if item already exists in cart
        $existingItem = $this->cartModel
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingItem) {
            // Update quantity
            $newQuantity = $existingItem['quantity'] + $quantity;
            $this->cartModel->update($existingItem['cart_id'], [
                'quantity' => $newQuantity
            ]);
        } else {
            // Add new item
            $this->cartModel->insert([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Added to cart successfully'
        ]);
    }

    // Update quantity
    public function updateQuantity()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Please login first'
            ]);
        }

        $cartId = $this->request->getPost('cart_id');
        $quantity = $this->request->getPost('quantity');

        if ($quantity < 1) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Quantity must be at least 1'
            ]);
        }

        $this->cartModel->update($cartId, ['quantity' => $quantity]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Quantity updated'
        ]);
    }

    // Remove from cart
    public function remove($cartId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/bsb_signin')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        
        // Verify item belongs to user
        $item = $this->cartModel->find($cartId);
        if ($item && $item['user_id'] == $userId) {
            $this->cartModel->delete($cartId);
            return redirect()->to('/cart')->with('success', 'Item removed from cart');
        }

        return redirect()->to('/cart')->with('error', 'Unable to remove item');
    }

    // Clear cart
    public function clear()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/bsb_signin')->with('error', 'Please login first');
        }

        $userId = session()->get('user_id');
        $this->cartModel->where('user_id', $userId)->delete();

        return redirect()->to('/cart')->with('success', 'Cart cleared');
    }

    // Get cart item count (for header badge)
    public function count()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON(['count' => 0]);
        }

        $userId = session()->get('user_id');
        $count = $this->cartModel->where('user_id', $userId)->countAllResults();

        return $this->response->setJSON(['count' => $count]);
    }
}
