<?php

Class Index extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper('url');
        $this->load->model('quizz_model','', TRUE);
    }

    public function index() {       
        if ($this->session->userdata('logged_in')) {
            $this->load->model('quizz_model');
            $data['query'] = $this->quizz_model->showquizz(4);
            $data['listtest'] = $this->quizz_model->showquizz(15);
            $data['topresult'] = $this->quizz_model->gettopresult();
            //var_dump($topresult);die;
            $session_data = $this->session->userdata('logged_in');
            $data['usersname'] = $session_data['usersname'];
            $data['groupid'] = $session_data['groupid'];
            $this->load->view('template/header',$data);            
            $this->load->view('home_view', $data);
            $this->load->view('template/footer');
        }else {
            redirect(base_url().'user', 'refresh');            
        }
    }
    

}
