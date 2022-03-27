<?php
namespace App\Controllers;
use App\Controllers\User;
use App\Models\M_vot_user;
use App\Models\M_vot_cluster;
use App\Models\M_vot_role;

class User_manage extends Vot_controller {

    public function index() {
        session_start();
        if ($_SESSION["usr_role"] != '5') {
            echo "Access denied, Admin only";
            exit(0);
        }
        try {
            $m_usr = new M_vot_user();
            $data['arr_user'] = $m_usr
                ->orderBy('usr_id', 'DESC')
                ->join('vot_role', 'usr_role = rol_id', 'LEFT')
                ->join('vot_cluster', 'usr_cluster_id = cst_id', 'LEFT')
                ->findAll();

            $m_cst = new M_vot_cluster();
            $data['opt_cluster'] = $m_cst
                ->orderBy('cst_id', 'ASC')
                ->findAll();

            $m_rol = new M_vot_role();
            $data['opt_role'] = $m_rol
                ->orderBy('rol_id', 'ASC')
                ->findAll();

            return view('User_manage/v_user_list', $data);
        } catch(\Exception $e) {
            die($e->getMessage());
        }
    }
    public function insert() {
        try {
            $m_usr = new M_vot_user();
            $data = $this->request->getPost();
            $data['usr_password'] = md5($data['usr_password']);
            $m_usr->insert($data);

            return $this->response->redirect(base_url() . "/User_manage");
        } catch(\Exception $e) {
            die($e->getMessage());
        }
    }
    public function update() {
        try {
            $m_usr = new M_vot_user();
            $data = $this->request->getPost();
            
            if ($data['usr_password'] == '') {
                unset($data['usr_password']);
            } else {
                $data['usr_password'] = md5($data['usr_password']);
            }

            if ($data['usr_role'] != '1') {
                $data['usr_cluster_id'] = NULL;
            }
            $m_usr->update($data['usr_id'], $data);

            return $this->response->redirect(base_url() . "/User_manage");
        } catch(\Exception $e) {
            die($e->getMessage());
        }
    }
    public function delete($usr_id) {
        if (!isset($_SESSION["usr_id"]))
            return $this->response->redirect(base_url('/login'));

        if ($_SESSION["usr_role"] != 5) {
            echo "Access denied, Admin only";
            exit(0);
        }

        try {
            $m_usr = new M_vot_user();
            $m_usr->delete($usr_id);

            return $this->response->redirect(base_url() . "/User_manage");
        } catch(\Exception $e) {
            die($e->getMessage());
        }
    }
}