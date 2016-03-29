<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Created by JetBrains PhpStorm.
 * User: isra
 * Date: 11/01/14
 * Time: 18:51
 * To change this template use File | Settings | File Templates.
 */
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->helper(array('form'));
        $this->load->view('login_view');
    }

//    public function __construct() {
//        parent::__construct();
//        $this->load->model('login_model');
//        $this->load->library(array('session', 'form_validation'));
//        $this->load->helper(array('url', 'form'));
//        $this->load->database('default');
//    }
//
//    public function index() {       
//        switch ($this->session->userdata('groupid')) {
//            case '':
//                $data['token'] = $this->token();
//                $data['titulo'] = 'Login Control Panel';
//                $this->load->view('login_view', $data);
//                break;
//            case 0:
//                redirect(base_url() . 'admin');
//                break;
//            case 1:
//                redirect(base_url() . 'edituser');
//                break;
//            case 2:
//                redirect(base_url() . 'suscriptor');
//                break;
//            default:
//                $data['titulo'] = 'Login con roles de usuario en codeigniter';
//                $this->load->view('login_view', $data);
//                break;
//        }
//    }
//
//    public function token() {
//        $token = md5(uniqid(rand(), true));
//        $this->session->set_userdata('token', $token);
//        return $token;
//    }
//
//    public function new_user() {
//        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {
//            $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
//            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[6]|max_length[150]|xss_clean');
//
//            //lanzamos mensajes de error si es que los hay
//            $this->form_validation->set_message('required', 'El %s chưa được nhập');
//            $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
//            $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
//            if ($this->form_validation->run() == FALSE) {
//                $this->index();
//            } else {
//                $username = $this->input->post('username');
//                $password = sha1($this->input->post('password'));
//                $check_user = $this->login_model->login_user($username, $password);
//                if ($check_user == TRUE) {
//                    $data = array(
//                        'is_logued_in' => TRUE,
//                        'id' => $check_user->id,
//                        'username' => $check_user->usersname,
//                        'email' => $check_user->email,
//                        'groupid' => $check_user->groupid,
//                    );
//                    $this->session->set_userdata($data);
//                    $this->index();
//                }
//            }
//        } else {
//            redirect(base_url() . 'login');
//        }
//    }
//
//    public function logout_ci() {
//        $this->session->sess_destroy();
//        $this->index();
//    }
}
