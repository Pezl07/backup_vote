<?php

namespace App\Models;

use CodeIgniter\Model;

class Da_vot_vote extends Model
{
    protected $table = 'vot_vote';
    protected $primaryKey = 'vot_id';
    protected $allowedFields = [
        'vot_score', 'vot_cluster_id', 'vot_user_id'
    ];

    function insert_vote($vote = NULL, $user_id = NULL) {
        for($i = 0; $i < count($vote); $i++) {
            intval($vote[$i]);
            if($vote[$i] > 0){
                $sql = "INSERT INTO $this->table VALUES (NULL, $vote[$i], $i, $user_id)";
                $this->db->query($sql);
            }   
        }
    }

}