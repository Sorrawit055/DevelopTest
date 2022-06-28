<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class ProductCategoryModel extends Model{

    protected $table = 'productcategory';
    protected $primaryKey = 'categoryid';
    protected $allowedFields = [
        'code',
        'categoryname',
        'status',
        'code'
    ];

}