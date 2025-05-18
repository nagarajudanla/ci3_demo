<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Users extends CI_Controller 
{
    function __construct(){
        parent::__construct();

        $this->load->library('form_validation'); 
        $this->load->helper('url', 'form');
        $this->load->model(['User', 'Department']);
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    } 

    public function index(){
        $this->load->view('common/header'); 
        $this->load->model('department');
        $data['departments'] = $this->department->department_list();
        $this->load->view('common/header');
        $this->load->view('users/registration', $data);
        $this->load->view('common/footer'); 
    }

    public function login(){
        $this->load->view('common/header'); 
        $this->load->view('users/login');
        $this->load->view('common/footer'); 
    }

    public function register() {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Load departments for dropdown
        $data['departments'] = $this->Department->department_list();
        $data['validation_errors'] = '';
        $data['error_msg'] = '';

        // Set validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).+$/]',
            ['regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, and one special character.']
        );
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|is_unique[users.phone]');
        $this->form_validation->set_rules('department', 'Department', 'required');
        $this->form_validation->set_rules('designation', 'Designation', 'required');
        


        if ($this->form_validation->run() == TRUE) {
            // if ($this->input->post()) {
            $userData = array(
                'first_name'    => $this->input->post('first_name'),
                'last_name'     => $this->input->post('last_name'),
                'email'         => $this->input->post('email'),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'phone'         => $this->input->post('phone'),
                'department_id' => $this->input->post('department'),
                'designation'   => $this->input->post('designation'),
            );

            if ($this->User->insert($userData)) {
                $this->session->set_flashdata('success_msg', 'Account created successfully.');
                redirect('users/login');
            } else {
                $this->session->set_flashdata('error_msg', 'Something went wrong while saving your account.');
                redirect('users/register');
            }
           // echo $this->db->last_query(); die;
        } else {
            $data['validation_errors'] = validation_errors();
        }

        $this->load->view('common/header');
        $this->load->view('users/registration', $data);
        $this->load->view('common/footer');
    }

    public function user_access(){
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('User');

        $data['error_msg'] = '';

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User->getUserByEmail($email);
            if (!empty($user) && password_verify($password, $user['password'])) {
                $userData = [
                    'user_id'        => $user['id'],
                    'first_name'     => $user['first_name'],
                    'last_name'     => $user['last_name'],
                    'email'          => $user['email'],
                    'phone'          => $user['phone'],
                    'employee_type'  => $user['employee_type'],
                    'salary'  => $user['salary'],
                    'is_logged_in'   => TRUE
                ];
                $this->session->set_userdata($userData);
                $user_id = $this->session->userdata('user_id');
                $email = $this->session->userdata('email');

                if ($user['employee_type'] == 1) {
                    redirect('users/adminDashboard');
                } else {
                    redirect('users/userDashboard');
                }
            } else {
                
                $this->session->set_flashdata('error_msg', 'Invalid Login Details please check');
                redirect('users/login');
            }
        }
        $this->load->view('users/login', $data);
    }
      
    public function adminDashboard(){
        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('employee_type') != 1) {
            redirect('users/login');
        }

        $this->load->model('User');
        $this->load->model('Department');

        $data['users'] = $this->User->getAllUsers();
        $data['departments'] = $this->Department->department_list();

        $this->load->view('common/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('common/footer');
    }

    public function userDashboard(){
        if (!$this->session->userdata('is_logged_in') || $this->session->userdata('employee_type') != 0) {
            redirect('users/login');
        }

        $this->load->view('common/header');
        $this->load->view('users/userDashboard');
        $this->load->view('common/footer');
    }

    public function logout(){
        // Unset session data
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('first_name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('employee_type');
        $this->session->unset_userdata('is_logged_in');
        $this->session->sess_destroy();
        redirect('users/login');
    }

    public function editUser($id){
        $this->load->model('User');
        $this->load->model('Department');
        $this->load->library('form_validation');
        $this->load->helper('form');

        $data['user'] = $this->User->getUserById($id);
        $data['departments'] = $this->Department->department_list();

        if (empty($data['user'])) {
            show_404(); // User not found
        }

        // Set validation rules
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        if ($this->form_validation->run() === TRUE) {
            $updateData = [
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'email'      => $this->input->post('email'),
                'phone'      => $this->input->post('phone'),
                'department_id' => $this->input->post('department_id'),
                'employee_type' => $this->input->post('employee_type'),
                'status'        => $this->input->post('status')
            ];

            $this->User->updateUser($id, $updateData);
            $this->session->set_flashdata('success', 'User updated successfully.');
            redirect('users/adminDashboard');
        }

        $this->load->view('common/header');
        $this->load->view('admin/edit_user', $data);
        $this->load->view('common/footer');
    }

    public function updateUser($id){
        $this->load->model('User');

        $data = array(
            'first_name'    => $this->input->post('first_name'),
            'last_name'     => $this->input->post('last_name'),
            'email'         => $this->input->post('email'),
            'phone'         => $this->input->post('phone'),
            'department_id' => $this->input->post('department'),
            'designation'   => $this->input->post('designation'),
            'salary'        => $this->input->post('salary'),
            'status'        => $this->input->post('status')
        );
        $this->User->updateUser($id, $data);
        redirect('users/adminDashboard');
    }

    public function delete_user($id){
        $this->load->model('User'); 

        if ($this->User->softDeleteUser($id)) {
            $this->session->set_flashdata('success_msg', 'User deleted (status changed).');
        } else {
            $this->session->set_flashdata('error_msg', 'Failed to delete user.');
        }
        redirect('users/adminDashboard');
    }

    public function toggleUserStatus($id){
        $this->load->model('User');
        $user = $this->User->getUserById($id);
        if ($user) {
            $newStatus = ($user['status'] == 1) ? 0 : 1;
            $this->User->updateUserStatus($id, $newStatus);
            $this->session->set_flashdata('success_msg', 'User status updated.');
        }
        redirect('users/adminDashboard');
    }

}