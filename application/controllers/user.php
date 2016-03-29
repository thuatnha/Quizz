<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper('url');
        $this->load->model('users', '', TRUE);
    }

    public function index() {
        if (!isset($this->session->userdata['logged_in'])) {
            $this->load->helper(array('form'));
            $this->load->view('header');
            $this->load->view('login_view');
            $this->load->view('template/footer');
        } else {
            redirect(base_url() . 'admin', 'refresh');
        }
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        //session_destroy();
        redirect(base_url() . 'user', 'refresh');
    }

    function register() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('class', 'Class', 'required');
        $this->form_validation->set_rules('fullname', 'FullName', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_check');
        $data['class'] = $this->users->getclass();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('register_view',$data);
            $this->load->view('template/footer');
        } else {
            $username = $this->input->post('username');
            $password = sha1($this->input->post('password'));
            $email = $this->input->post('email');
            $class = $this->input->post('class');
            $fullname = $this->input->post('fullname');
            $result = $this->users->insert_user($username,$password,$email,$class,$fullname);
            if($result == true ){
                $this->load->view('header');
                $this->load->view('registersuccess_view');
                $this->load->view('template/footer');
            }else {
                redirect(base_url() . 'index.php/user/register','refresh');
            }
        }
    }

    function username_check() {
        $username = $this->input->post('username');
        $result = $this->users->check_info('user_name', $username);
        return $result;
    }

    function email_check() {
        $email = $this->input->post('email');
        $result = $this->users->check_info('user_email', $email);
        return $result;
    }

}
