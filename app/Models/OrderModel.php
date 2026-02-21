<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'order_tbl';
    protected $primaryKey = 'order_id';

    protected $allowedFields = [
        'user_id', 'product_name', 'description', 'price', 'order_date', 'status'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'order_date';
}