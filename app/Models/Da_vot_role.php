<?php
namespace App\Models;
use CodeIgniter\Model;

class Da_vot_role extends Model {
    protected $table = 'vot_role';
    protected $primaryKey = 'rol_id';
    protected $allowedFields = ['rol_name'];
}