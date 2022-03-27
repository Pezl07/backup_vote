<?php
namespace App\Models;
use App\Models\Da_vot_cluster;

class M_vot_cluster extends Da_vot_cluster {

    public function get_all() {
        $sql = "SELECT * FROM $this->table ";
        return $this->db->query($sql)->getResult();
    }

}
