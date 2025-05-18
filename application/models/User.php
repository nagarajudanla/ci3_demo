<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User extends CI_Model{ 
    protected $table = 'users'; // Make sure your table is named 'users'

    public function __construct() {
        parent::__construct();
    }

    public function insert($data = array()) {
        if (!empty($data)) {
            $insert = $this->db->insert($this->table, $data);
            if (!$insert) {
                log_message('error', 'DB Insert Failed: ' . print_r($data, true));
                log_message('error', 'Last Query: ' . $this->db->last_query());
                log_message('error', 'DB Error: ' . $this->db->error()['message']);
                return false;
            }

            return $this->db->insert_id();
        }
        return false;
    }

    
    public function checkEmailExists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    public function getUserByEmail($email)
    {
        $query = $this->db->get_where('users', ['email' => $email, 'status' => 1]);
        return $query->row_array();
    }

    public function getAllUsers()
    {
        $this->db->select('users.*, departments.name as department_name');
        $this->db->from('users');
        $this->db->join('departments', 'departments.id = users.department_id', 'left');
        $this->db->where('users.employee_type !=', 1); // Exclude Admins
        $this->db->where('users.status !=', 2);        // Exclude deleted users, if status 2 means deleted
        return $this->db->get()->result_array();
    }


    public function getUserById($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function updateUser($id, $data)
    {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function softDeleteUser($id)
    {
        $data = ['status' => 2];  // 2 = Deleted
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function updateUserStatus($id, $status)
{
    return $this->db->where('id', $id)->update('users', ['status' => $status]);
}

}