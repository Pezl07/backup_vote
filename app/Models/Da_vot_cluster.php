<?php

namespace App\Models;

use CodeIgniter\Model;

class Da_vot_cluster extends Model
{
    protected $table = 'vot_cluster';
    protected $primaryKey = 'cst_id  ';
    protected $allowedFields = [
        'cst_number', 'cst_total_score', 'cst_image', 'cst_system_image '
    ];

    public function add_total_score($score, $cst_id) {
        $sql = "UPDATE `vot_cluster` SET cst_total_score = cst_total_score + $score
                WHERE cst_id = $cst_id";
        $this->db->query($sql);
    }
}