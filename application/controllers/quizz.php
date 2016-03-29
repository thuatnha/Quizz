<?php

class Quizz extends CI_Controller {

    var $data = array();
    var $user = array();
    var $test_json = array();
    var $test_json_data = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('quizz_model', '', TRUE);
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        if (!isset($this->session->userdata['logged_in'])) {
            redirect(base_url() . 'user');
        } else {
            
        }
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('quizz_model');
            $data['query'] = $this->quizz_model->showquizzcate(0, 20);
            $session_data = $this->session->userdata('logged_in');
            $user['usersname'] = $session_data['usersname'];
            $user['groupid'] = $session_data['groupid'];
            $this->load->view('template/header', $user);
            $this->load->view('quizz_view', $data);
            $this->load->view('template/footer');
        } else {
            redirect(base_url() . 'user', 'refresh');
        }
    }

    function show_quizz($idsubjects) {
        $id = intval($idsubjects);
        if ($id > 0) {
            $this->load->model('quizz_model');
            $data['query'] = $this->quizz_model->showquizzcate($id, 20);
            $session_data = $this->session->userdata('logged_in');
            $user['usersname'] = $session_data['usersname'];
            $user['groupid'] = $session_data['groupid'];
            $data['catename'] = $this->quizz_model->showsubject($id);
            $this->load->view('template/header', $user);
            $this->load->view('quizzcate_view', $data);
            $this->load->view('template/footer');
        } else {
            redirect(base_url() . 'quizz', 'refresh');
        }
    }

    function start_quizz($idtest) {
        $counttest = 0;
        if ($this->session->userdata('logged_in')) {
            $this->load->library('form_validation');
            $session_data = $this->session->userdata('logged_in');
            $user['usersname'] = $session_data['usersname'];
            $userid = $session_data['id'];
            $data['userid'] = $userid;
            $this->load->model('quizz_model');
            $numtest = $this->quizz_model->getnumtest($idtest,$userid);
            //var_dump($numtest);die;
            //$numtest = '';
            if(empty($numtest)){                
                $data['infotest'] = $this->quizz_model->showquizztest($idtest);
                $data['infojson'] = $this->quizz_model->getlinkjsonbytestid($idtest);
                //var_dump($data['infojson']);die;
                if($data['infojson']!='No_data'){
                    $counttest = $counttest + 1;
                    $this->quizz_model->insertresult($idtest,$userid,$counttest, $data['infojson'][0]->linkid);
                    $data['query'] = $this->quizz_model->starttest($idtest);
                    $this->load->view('template/header', $user);
                    $this->load->view('quizz_starttest', $data);
                    $this->load->view('template/footer');
                }else {
                    $data['msg'] = 'Chưa có đề thi trong kỳ thi này.';
                    $this->load->view('template/header', $user);
                    $this->load->view('quizz_msg', $data);
                    $this->load->view('template/footer');
                }                                
               
            }else if($numtest[0]->result_numtest<3){
                $counttest = $numtest[0]->result_numtest + 1;
                $this->quizz_model->insertresult($idtest,$userid,$counttest,$numtest[0]->linkid);
                $data['infotest'] = $this->quizz_model->showquizztest($idtest);
                $data['infojson'] = $this->quizz_model->getlinkbytestidlinkid($idtest,$numtest[0]->linkid);
                //var_dump($data['infojson']);die;
                $data['query'] = $this->quizz_model->starttest($idtest);
                $this->load->view('template/header', $user);
                $this->load->view('quizz_starttest', $data);
                $this->load->view('template/footer');
            }else {
                $data['msg'] = 'Bạn đã hết lượt kiểm tra. Mỗi thành viên được phép thi 3 lần.';
                $this->load->view('template/header', $user);
                $this->load->view('quizz_msg', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect(base_url() . 'user', 'refresh');
        }
    }

    function result_quizz($function) {
        if ($function == 'questionlink') {
            $session_data = $this->session->userdata('logged_in');
            $user['usersname'] = $session_data['usersname'];
            $num_test_json = 0;
            $num_arrayanwsers = 0;
            $num_result = 0;
            $name = '';
            $testid = $this->input->post('test_id');
            $userid = $this->input->post('user_id'); //nen lay tu session
            $linkid = $this->input->post('link_id');
            $numanwsers = $this->input->post('numanwsers');
            $arrayanwsers = array();
            $infojson = array();
            for ($i = 1; $i <= $numanwsers; $i++) {
                $name = 'answer_' . $i;
                if (isset($_POST[$name])) {
                    $dataanwsers = $this->input->post($name);
                } else {
                    $dataanwsers = '';
                }
                array_push($arrayanwsers, $dataanwsers);
            }
            $infojson = $this->quizz_model->getlinkbytestidlinkid($testid,$linkid);
            //echo $testid.' '.$linkid;
            //var_dump($infojson);die;
            $test_json = $this->quizz_model->showquizztest($testid);
            $data['infotest'] = $test_json;
            $test_json_data = json_decode($infojson[0]->test_json);
            $test_numanwsers = $infojson[0]->test_numanwsers;
            $num_test_json = count($test_json_data);
            $num_arrayanwsers = count($arrayanwsers);
            
            if (($num_test_json == $num_arrayanwsers) && ($num_test_json > 0 || $num_arrayanwsers > 0)) {
                for ($k = 0; $k < $num_arrayanwsers; $k++) {
                    if (($arrayanwsers[$k] == $test_json_data[$k]) && !empty($arrayanwsers[$k])) {
                        $num_result = $num_result + 1;
                    }
                }
                $result_points = floor($num_result*10/$num_arrayanwsers);
                $this->quizz_model->insertresultjson($testid, $userid, json_encode($arrayanwsers),$result_points);
                $data['rerultuser'] = $result_points;
                $data['num_result'] = $num_result;
                $data['num_arrayanwsers'] = $num_arrayanwsers;
                $data['num_test_json'] = $num_test_json;
                $data['test_numanwsers'] = $test_numanwsers;
                
            } else {
                
            }
            $this->load->view('template/header', $user);
            $this->load->view('quizz_result', $data);
            $this->load->view('template/footer');
        } else {
            $data['msg'] = 'Có lỗi xảy ra. Bạn vui lòng báo với quản trị site.';
            $this->load->view('template/header', $user);
            $this->load->view('quizz_msg', $data);
            $this->load->view('template/footer');
        }
    }
    
    function intro($idtest){
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $test_json = $this->quizz_model->showquizztest($idtest);
        $data['infotest'] = $test_json;
        $this->load->view('template/header', $user);
        $this->load->view('quizz_intro', $data);
        $this->load->view('template/footer');
    }

}
