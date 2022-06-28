<?php 

namespace App\Models;  
use CodeIgniter\Model;

  
class UserModel extends Model{

    protected $table = 'user';
    protected $primaryKey = 'userid';
    protected $allowedFields = [
        'name',
        'surname',
        'username',
        'password',
        'status',
    ];

}