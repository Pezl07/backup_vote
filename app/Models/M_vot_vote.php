<?php
namespace App\Models;
use App\Models\Da_vot_vote;

class M_vot_vote extends Da_vot_vote {

    public function get_all() {
        $sql = "SELECT * FROM $this->table ";
        return $this->db->query($sql)->getResult();
    }

}
