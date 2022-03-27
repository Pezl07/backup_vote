<?php
namespace App\Models;
use App\Models\Da_vot_user;

class M_vot_user extends Da_vot_user {
    public function get_by_usr_name($usr_name) {
        $sql = "SELECT * FROM vot_user 
                LEFT JOIN vot_cluster ON usr_cluster_id = cst_id
                LEFT JOIN vot_role ON usr_role = rol_id
                WHERE `usr_name` = '$usr_name'";
        return $this->db->query($sql)->getRow();
    }
    public function get_usr_remain_score_by_usr_id($usr_id) {
        $sql = "SELECT usr_remain_score FROM vot_user WHERE usr_id = '$usr_id'";
        return $this->db->query($sql)->getRow();
    }
    public function get_by_usr_id($usr_id) {
        $sql = "SELECT * FROM vot_user WHERE usr_id = '$usr_id'";
        return $this->db->query($sql)->getRow();
    }
    public function minus_usr_remain_score($score, $usr_id) {
        $sql = "UPDATE `vot_user` SET usr_remain_score = usr_remain_score - $score
                WHERE usr_id = '$usr_id'";
        return $this->db->query($sql); 
    }
}
