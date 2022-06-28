<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class OrderModel extends Model{

    protected $table = 'order';
    protected $primaryKey = 'orderid';
    protected $allowedFields = [
        'datetime',
        'userid',
        'cusid',
        'total_price',
        'order_status',
    ];

}