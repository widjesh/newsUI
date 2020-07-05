<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in) {
            redirect('Dashboard');
        } else {
            $this->load->view('user_login', ['message' => 'Login']);
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('first_name', 'First name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('user_register');
        } else {
            $data['email'] = $this->input->post('email');
            $data['password'] = md5(sha1($this->input->post('password')));
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');

            $this->UserModel->insert($data);

            $this->load->view('user_login', array('message' => 'Registration successful completed. Please contact admin for change you level.'));
        }
    }

    public function login()
    {

        $password = $this->input->post('password');
        $email = $this->input->post('email');

        $row = $this->UserModel->check_login($email, $password);
        if (empty($row)) {
            $this->load->view('user_login', array('message' => 'Login or password wrong'));
        } elseif ($row->level == 0) {
            $this->load->view('user_login', array('message' => 'Please contact admin for change you level. You have not access for enter admin area.'));
        } else {
            $session_data = array(
                'user_id' => $row->id,
                'email' => $row->email,
                'level' => $row->level,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($session_data);
            redirect('Dashboard');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('user_id', 'email', 'logged_in'));
        redirect('User');
    }

    public function edit()
    {
        $userData = $this->session->userdata();
        $viewData['user'] = $this->UserModel->get(array('id' => $userData['user_id']));
        $viewData['title'] = 'Edit profile';

        if (isset($_POST['first_name'])) {
            $viewData['user']->first_name = $this->input->post('first_name');
            $viewData['user']->last_name = $this->input->post('last_name');

            if (isset($_POST['password'])) {
                $pass = $this->input->post('password');
                $trypass = $this->input->post('trypassword');
                if ($pass == $trypass) {
                    $viewData['user']->password = md5(sha1($pass));
                }
            }

            $update = $this->UserModel->update($viewData['user'], array('id' => $userData['user_id']));
            if ($update) {
                $viewData['message'] = 'Profile update successful.';
            }
        }

        $this->load->view('edit/user', $viewData);
    }
}