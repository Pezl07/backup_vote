<?php

namespace App\Models;

use CodeIgniter\Model;

class Da_vot_user extends Model
{
    protected $table = 'vot_user';
    protected $primaryKey = 'usr_id';
    protected $allowedFields = [
        'usr_name', 'usr_password', 'usr_full_name', 'usr_cluster_id', 'usr_role', 'usr_remain_score', 'usr_image'
    ];
}