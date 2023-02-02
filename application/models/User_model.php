<?php

defined('BASEPATH') or exit('No direct script access allowed');



/**

 *

 */

class User_model extends CI_Model

{

    public function get_search_user($txt_search)
    {
        $rs = $this->db
            ->like('name', $txt_search)
            ->get('mas_users')
            ->result();
        return $rs;
    }

    function do_auth($username, $password)
    {
        $rs = $this->db
            //->select('id,org_name')
            ->where('CID', $username)
            ->where('BIRTH', $password, false)
            ->get('t_person_cid_hash')
            ->row_array();
        //echo $this->db->last_query();
        return $rs;
    }
    

    public function save_user($data)
    {
        $rs = $this->db
            ->set('prename', $data['prename'])
            ->set('name', $data['name'])
            ->set('cid', $data['cid'])
            ->set('username', $data['username'])
            ->set('hospcode', $data['hospcode'])
            ->set('group', $data['group'])
            ->set('employee_type', $data['employee_type'])
            ->set('email', $data['email'])
            ->set('position', $data['position'])
            ->set('user_mobile', $data['user_mobile'])
            ->insert('mas_users');
        return $rs;
    }
    public function regis_auth_mobile($tel, $name)
    {
        $rs = $this->db
            ->set('tel', $tel)
            ->set('name', $name)
            ->insert('users');
        return $rs;
    }
    public function update_user($data)
    {
        $rs = $this->db
            ->where('id', $data['id'])
            ->set('prename', $data['prename'])
            ->set('name', $data['name'])
            ->set('cid', $data['cid'])
            ->set('username', $data['username'])
            ->set('hospcode', $data['hospcode'])
            ->set('group', $data['group'])
            ->set('employee_type', $data['employee_type'])
            ->set('email', $data['email'])
            ->set('position', $data['position'])
            ->set('user_mobile', $data['user_mobile'])
            ->update('mas_users');
        return $rs;
    }
    public function update_password($data)
    {
        $rs = $this->db
            ->where('id', $data['id'])
            ->set('password', "PASSWORD('" . $data['password'] . "')", false)
            ->update('mas_users');
        return $rs;
    }
    public function get_member_name($id)
    {
        $rs = $this->db
            ->where('id', $id)
            ->get('mas_users')
            ->result();
        return $rs ? $rs->prename . $rs->name : '-';
    }
}
