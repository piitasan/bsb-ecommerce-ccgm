<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product_tbl';
    protected $primaryKey = 'product_id';

    protected $allowedFields = [
        'product_category', 'product_name', 'description', 'price', 
        'stock_quantity', 'image_url', 'reviews_count', 'average_rating'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
