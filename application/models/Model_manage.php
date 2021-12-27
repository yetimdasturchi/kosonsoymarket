<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_manage extends CI_Model 
{
    public function logged()
    {
        if ($this->session->userdata('logged') == 1){
            return true;
        }else{
            return false;
        }
    }

    public function check_username($username) 
	{
        $where = array(
			'username' => $username
		);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
    }

    public function check_password($username,$password)
    {
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    public function user($user_id)
    {
    	$where = array(
			'user_id' => $user_id
		);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
    }

    public function check_permissions($key='') 
    {
        $data = $this->session->userdata('permissions');
        $data = json_decode($data, true);
        if (is_array($data)) {
            if (in_array('all', $data)) {
                return true;
            }else if (in_array($key, $data)) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}