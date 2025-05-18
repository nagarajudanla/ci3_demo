<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Department');
    }

    public function save() {
        $name = $this->input->post('name');

        if (!empty($name)) {
            $data = [
                'name' => $name,
                'status' => 1
            ];
            $this->Department->insert($data);
            $this->session->set_flashdata('success', 'Department added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Department name cannot be empty.');
        }

        redirect('users/adminDashboard');
    }

    public function edit($id) {
        // Similar to save, you can implement update functionality here
    }

    public function delete($id) {
        $this->Department->softDelete($id);
        redirect('users/adminDashboard');
    }

    // public function toggleStatus($id) {
    //     $this->Department>toggleStatus($id);
    //     redirect('users/adminDashboard');
    // }
}
