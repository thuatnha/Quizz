<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('users', '', TRUE);
        $this->load->database('default');
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper('url');
    }

    function index() {        
        $this->load->library('form_validation');        
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $this->load->view('template/header');
            $this->load->view('login_view');
            $this->load->view('template/footer');
            
        } else {           
            redirect(base_url(), 'refresh');
        }
    }

    function check_database($password) {
        $username = $this->input->post('username');
        $password = sha1($this->input->post('password'));
        $result = $this->users->login($username, $password);

        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'id' => $row->userid,
                    'usersname' => $row->user_name,
                    'groupid' =>$row->groupid,
                );
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Tên tài khoản hoặc mật khẩu không đúng');
            return false;
        }
    }

}

?>