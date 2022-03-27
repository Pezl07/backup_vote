<?php
namespace App\Controllers;
use App\Models\M_vot_user;

class User {
    private $usr_id = NULL; // nullable
    private $usr_name; // can be email
    private $usr_password = NULL; // null for email login
    private $usr_full_name;
    private $usr_cluster_id = NULL; // nullable
    private $usr_role; // 1 = student, 2 = teacher, 3 = PO, 4 = admin
    private $usr_remain_score;
    private $usr_image = NULL; // nullable
    private $m_usr;

    function __construct($usr_id, $usr_name, $usr_password, $usr_full_name, $usr_cluster_id, $usr_role, $usr_remain_score, $usr_image) {
        $this->usr_id = $usr_id;
        $this->usr_name = $usr_name;
        $this->usr_password = $usr_password;
        $this->usr_full_name = $usr_full_name;
        $this->usr_cluster_id = $usr_cluster_id;
        $this->usr_role = $usr_role;
        $this->usr_remain_score = $usr_remain_score;
        $this->usr_image = $usr_image;
        $this->m_usr = new M_vot_user();
    }

    public function insert_user() {
        $this->m_usr->insert_user(
            $this->usr_name,
            $this->usr_password,
            $this->usr_full_name,
            $this->usr_cluster_id,
            $this->usr_role,
            $this->usr_remain_score,
            $this->usr_image
        );
    }

    public function check_user_exist() {
        $obj_user = $this->m_usr->get_by_usr_name($this->usr_name);
        return ($obj_user != NULL);
    }

    public function check_valid_usr_name() {
        return ($this->usr_name[0] == "6" && substr($this->usr_name, 2, 2) == "16" && substr($this->usr_name, 8) == "@go.buu.ac.th");
    }
}
?>