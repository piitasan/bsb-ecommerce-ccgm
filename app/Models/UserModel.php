<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user_tbl';
    protected $primaryKey = 'user_id';

    protected $allowedFields = [
        'user_name', 'first_name', 'last_name', 'email', 'phone_number', 'password'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}