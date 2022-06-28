<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class ProductModel extends Model{

    protected $table = 'product';
    protected $primaryKey = 'productid';
    protected $allowedFields = [
        'productname',
        'categoryid',
        'status',
        'price',
        'code',
    ];

}