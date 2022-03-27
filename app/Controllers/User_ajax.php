<?php
namespace App\Controllers;
use App\Models\M_vot_user;

class User_ajax extends Vot_controller {
    public function get_user_ajax() {
        $usr_id = $this->request->getPost('usr_id');
        $m_usr = new M_vot_user();
        $data['obj_user'] = $m_usr
            ->where('usr_id', $usr_id)
            ->first();
        return json_encode($data['obj_user']);
    }
}