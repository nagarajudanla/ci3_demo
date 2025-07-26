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
                'status' => 1,
            ];
            $this->Department->insert($data);
            $this->session->set_flashdata('success', 'Department added successfully.');
        } else {
            $this->session->set_flashdata('error', 'Department name cannot be empty.');
        }
        redirect('users/adminDashboard');
    }

    public function editDepartment($id) 
    {
        $this->load->model('Department');
        $this->load->library('form_validation');
        $this->load->helper('form');

        $data['department'] = $this->Department->get_department_by_id($id);

        if (empty($data['department'])) {
            show_404();
        }

        $this->form_validation->set_rules('name', 'Department Name', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('common/header');
            $this->load->view('admin/edit_department', $data);
            $this->load->view('common/footer');
        } else {
            $this->Department->update_department($id);
            $this->session->set_flashdata('success', 'Department updated successfully');
            redirect('department/index');
        }
    }

    public function updateDepartment($id){
        $this->load->model('Department');
        $data = array(
            'name'    => $this->input->post('name'),
        );
        $this->Department->update_department($id, $data);
        redirect('users/adminDashboard');
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
