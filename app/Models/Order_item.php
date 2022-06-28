<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class Order_item extends Model{

    protected $table = 'order_item';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'orderid',
        'productid',
        'cusid',
        'price',
    ];

}