<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    public $user_id;
    public $provcode;

    public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('default_layout');
        $this->db = $this->load->database('default', true);
        $this->load->model('User_model', 'user');
        $this->load->model('Basic_model', 'basic');
        //$this->layout->setLeft('layout/left_user');
        $this->user_id = $this->session->userdata('id');
        $this->provcode = '44';
    }

    public function index()
    {
        $this->login();
    }

    public function  search_user()
    {

        $txt_search = $this->input->post('txt_search');
        $rs = $this->user->get_search_user($txt_search);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows . '}';
        render_json($json);
    }

    public function login()
    {
        if ($this->session->userdata('prov_login')==1) {
            redirect(site_url("health_status"), 'refresh');
           console_log('login'.$this->session->userdata('asm_login'));
        } else {
            $this->layout->view('user/login');
            console_log($this->session->userdata('fullname'));
        }
    }
    public function save_edit_profile()
    {
        $data = $this->input->post('items');
        $action = $this->input->post('action');
        if ($data['action'] == 'insert') {
            $rs = $this->user->save_user($data);
        } else if ($data['action'] == 'update') {
            $rs = $this->user->update_user($data);
        }
        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function save_edit_password()
    {
        $data = $this->input->post('items');

        $rs = $this->user->update_password($data);

        if ($rs) {
            $json = '{"success": true}';
        } else {
            $json = '{"success": false}';
        }

        render_json($json);
    }

    public function user_profile($id)
    {

        $rs = $this->user->get_userprofile($id);
        $data['office'] = $this->basic->sl_hospcode();
        $rs['fullname'] = $rs['prename'] . $rs['name'];
        $data['employee_type'] = $this->basic->sl_employee_type();
        $data['user_profiles'] = $rs;
        $this->layout->view('user/user_profile', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('user/login'), 'refresh');
    }

    
    public function do_auth()
    {
        $username = $this->input->post('username');
        $password = "'".to_mysql_date($this->input->post('password'))."'";
        //echo $check_user;
            $rs = $this->user->do_auth($username, $password);
            if ($rs['CID']) {
                $rs['user_login'] = true;
                $rs['cid']=$rs['CID'];
                $rs['name'] = $rs['NAME'];
                $rs['lname'] = $rs['LNAME'];
                $this->session->set_userdata($rs);
                $json = '{"success": true, "msg": "" }';
            } else {
                $json = '{"success": false, "msg": "Username หรือ Password ไม่ถูกต้อง"}';
            }


        render_json($json);
    }

}// ของ Class