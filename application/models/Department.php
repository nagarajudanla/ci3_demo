<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Department extends CI_Model
{ 
    function __construct() { 
        // Set table name 
        $this->table = 'department'; 
    } 

    public function department_list()
    {
        $sql = "select * from departments where status = '1' ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function insert($data) {
        return $this->db->insert('departments', $data);
    }

    public function softDelete($id) {
        return $this->db->update('departments', ['status' => 0], ['id' => $id]);
    }

    public function toggleStatus($id) {
        $dept = $this->db->get_where('departments', ['id' => $id])->row_array();
        $newStatus = ($dept['status'] == 1) ? 0 : 1;
        return $this->db->update('departments', ['status' => $newStatus], ['id' => $id]);
    }
}