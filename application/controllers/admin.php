<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model('quizz_model', '', TRUE);
        $this->load->model('admin_model', '', TRUE);
        $this->load->model('users', '', TRUE);
        if (!isset($this->session->userdata['logged_in'])) {
            redirect(base_url() . 'user');
        }
    }

    public function index() {
        $data = array();
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $user['groupid'] = $session_data['groupid'];
        if ($session_data['groupid'] <= 2) {
            $data['cate'] = $this->quizz_model->showallsubject();
            $data['user'] = $this->admin_model->listuser(10);
            $this->load->view('template/header', $user);
            $this->load->view('admin_view', $data);
            $this->load->view('template/footer');
        } else {
            $data['texterror'] = 'Bạn không có quyền truy cập trang này. Vui lòng kiểm tra lại';
            $this->load->view('template/header', $user);
            $this->load->view('admin_alert', $data);
            $this->load->view('template/footer');
        }
    }

    public function users() {
        echo 'Manager Users';
    }

    public function create_user() {
        echo 'Create User';
    }

    public function edit_user($id = 0) {
        $id = intval($id);
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $user['groupid'] = $session_data['groupid'];
        $this->load->library('form_validation');
        $user_title = '';
        $email = '';
        $groupid = '';
        $isactive = '';
        if ($session_data['groupid'] <= 2) {
            if (isset($_POST['user_title'])|| isset($_POST['user_email'])||isset($_POST['user_enabled'])|isset($_POST['groupid'])) {
                $user_title = $this->input->post('user_title');
                $email = $this->input->post('user_email');
                $groupid = $this->input->post('groupid');
                $isactive = $this->input->post('user_enabled');
                $result = $this->users->updateuser($id, $user_title, $email, $groupid, $isactive);
                if ($result == true) {
                    $texterror = 'Cập nhật thành công';
                } else {
                    $texterror = 'Cập nhật thất bại';
                }
                redirect(base_url() . 'index.php/admin/users?msg=' . $texterror);
            } else {
                $data['userinfo'] = $this->users->getuserbyid($id);
                $this->load->view('template/header', $user);
                $this->load->view('admin_edit_user', $data);
                $this->load->view('template/footer');
            }
        } else {
            $data['texterror'] = 'Bạn không có quyền truy cập trang này. Vui lòng kiểm tra lại';
            $this->load->view('template/header', $user);
            $this->load->view('admin_alert', $data);
            $this->load->view('template/footer');
        }
    }

    public function delete_user() {
        echo 'Delete User';
    }

    public function question() {
        echo 'Mamager Question';
    }

    public function create_question() {
        echo 'Create Question';
    }

    public function edit_question() {
        echo 'Edit Question';
    }

    public function delete_question() {
        echo 'Delete Question';
    }

    public function question_blank() {
        echo 'Manager Question';
    }

    public function category_test($id) {
        echo 'Manager Category Test';
    }

    public function add_category_test() {
        echo 'Add Category Test';
    }

    public function edit_category_test() {
        echo 'Edit Category Test';
    }

    public function delete_category_test() {
        echo 'Delete Category Test';
    }

    public function test($idcate = 0) {
        $id = intval($idcate);
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $user['groupid'] = $session_data['groupid'];
        $data['cate'] = $this->quizz_model->showallsubject();
        $data['groupid'] = $user['groupid'];
        if ($idcate > 0) {
            $data['test_cate'] = $this->quizz_model->showquizzcate($id, 20);
            $data['catename'] = $this->quizz_model->showsubject($id);
        } else {
            $data['test'] = $this->quizz_model->showquizz(30);
        }
        if (isset($_GET['msg'])) {
            $data['text'] = $_GET['msg'];
        }
        $this->load->view('template/header', $user);
        $this->load->view('admin_test', $data);
        $this->load->view('template/footer');
    }

    public function create_test() {
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $user['groupid'] = $session_data['groupid'];
        $data['cate'] = $this->quizz_model->showallsubject();
        $this->load->library('form_validation');
        $subjectid = '';
        $test_time = '';
        $test_type = '';
        $test_numanwsers = '';
        $test_link = '';
        $test_instructions = '';
        $test_name = '';
        $name = '';
        $texterror = '';
        $arrayanwsers = array();
        if (isset($_POST['test_name'])) {
            $test_name = $this->input->post('test_name');
            $subjectid = $this->input->post('subjectid');
            $test_instructions = $this->input->post('test_instructions');
            $test_time = $this->input->post('test_time');
            $test_type = $this->input->post('test_type');
            if ($test_type == 1) {
                $test_numanwsers = $this->input->post('test_numanwsers');
                $test_link = $this->input->post('test_link');
                if ($test_type == 1) {
                    for ($i = 1; $i <= $test_numanwsers; $i++) {
                        $name = 'answer_' . $i;
                        if (isset($_POST[$name])) {
                            $dataanwsers = $this->input->post($name);
                        } else {
                            $dataanwsers = '';
                        }
                        array_push($arrayanwsers, $dataanwsers);
                    }
                }
            }

            if ($test_name != '' && $subjectid != '' && $test_time != '' && $test_type != '') {
                $result = $this->admin_model->insert_test($test_name, $subjectid, $test_instructions, $test_time, $test_type, $test_link, $test_numanwsers, json_encode($arrayanwsers));
                if ($result == true) {
                    $texterror = 'Thêm kỳ thi thành công';
                } else {
                    $texterror = 'Thêm thất bại';
                }
            } else {
                $texterror = 'Vui lòng kiểm tra lại dữ liệu nhập vào';
            }

            redirect(base_url() . 'index.php/admin/test?msg=' . $texterror);
        } else {
            $this->load->view('template/header', $user);
            $this->load->view('admin_add_test', $data);
            $this->load->view('template/footer');
        }
    }
    public function create_entry(){
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $user['groupid'] = $session_data['groupid'];
        $data['cate'] = $this->quizz_model->showallsubject();
        $this->load->library('form_validation');
        $subjectid = '';
        $test_numanwsers = '';
        $test_link = '';
        $test_linkname = '';
        $texterror = '';
        $arrayanwsers = array();
        $file = '';
        if (isset($_POST['test_linkname'])) {
            /*var_dump($_FILES);die;
            if($_FILES["file"]["uploadfile"]){
                //echo 'upload';die;
                $dir = 'uploads/'.date("Ymd",time());
                $upload_config = array(
                    'upload_path' => $dir, 
                    'allowed_types' =>'pdf', 
                    'max_size' => 5210,
                );
                if(!is_dir($dir)){
                    mkdir($dir, 0777, true);
                }
                $this->load->library("app/uploader",$upload_config);
                $this->uploader->do_upload('file');
                $file = $this->upload->do_upload("file");
                $file_data = $this->upload->data();
                if($file){
                    $test_link = $file_data['file_name'];
                }else {
                    $texterror = 'tải file thất bại';
                    redirect(base_url() . 'index.php/admin/test?msg=' . $texterror);
                }
            }
            //echo 'noupload';die;*/
            // Cập nhật upload file trong version sau
           
            $test_linkname = $this->input->post('test_linkname');
            $subjectid = $this->input->post('subjectid');
            $test_numanwsers = $this->input->post('test_numanwsers');
            $test_link = $this->input->post('test_link');
            for ($i = 1; $i <= $test_numanwsers; $i++) {
                $name = 'answer_' . $i;
                if (isset($_POST[$name])) {
                    $dataanwsers = $this->input->post($name);
                } else {
                    $dataanwsers = '';
                }
                array_push($arrayanwsers, $dataanwsers);
            }
            if ($test_linkname != '' && $subjectid != '') {
                $result = $this->quizz_model->insertlinkjson($test_linkname, $test_link, $test_numanwsers, json_encode($arrayanwsers), $subjectid);
                if ($result == true) {
                    $texterror = 'Thêm đề thi thành công';
                } else {
                    $texterror = 'Thêm thất bại';
                }
            }else {
                $texterror = 'Vui lòng kiểm tra lại dữ liệu nhập vào';
            }
            redirect(base_url() . 'index.php/admin/test?msg=' . $texterror);
        }else {
            $this->load->view('template/header', $user);
            $this->load->view('admin_create_link', $data);
            $this->load->view('template/footer');
        }
    }
    
    function update_entry_to_test($idtest){
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $user['groupid'] = $session_data['groupid'];
        $data['cate'] = $this->quizz_model->showallsubject();               
    }

    public function add_test() {
        
    }

    public function edit_test($id) {
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $userid = $session_data['id'];
        $data['userid'] = $userid;
        $this->load->model('quizz_model');
        $data['infotest'] = $this->quizz_model->showquizztest($id);
        $data['cate'] = $this->quizz_model->showallsubject();
        $subjectid = '';
        $test_time = '';
        $test_type = '';
        $test_numanwsers = '';
        $test_link = '';
        $test_instructions = '';
        $test_name = '';
        $name = '';
        $texterror = '';
        $arrayanwsers = array();
        if (isset($_POST['test_name'])) {
            $test_name = $this->input->post('test_name');
            $subjectid = $this->input->post('subjectid');
            $test_instructions = $this->input->post('test_instructions');
            $test_time = $this->input->post('test_time');
            $test_type = $this->input->post('test_type');
            if ($test_type == 1) {
                $test_numanwsers = $this->input->post('test_numanwsers');
                $test_link = $this->input->post('test_link');
                if ($test_type == 1) {
                    for ($i = 1; $i <= $test_numanwsers; $i++) {
                        $name = 'answer_' . $i;
                        if (isset($_POST[$name])) {
                            $dataanwsers = $this->input->post($name);
                        } else {
                            $dataanwsers = '';
                        }
                        array_push($arrayanwsers, $dataanwsers);
                    }
                }
                if ($test_name != '' && $subjectid != '' && $test_time != '' && $test_type != '') {
                    $result = $this->admin_model->update_test($id, $test_name, $subjectid, $test_instructions, $test_time, $test_type, $test_link, $test_numanwsers, json_encode($arrayanwsers));
                    if ($result == true) {
                        $texterror = 'Sửa kỳ thi thành công';
                    } else {
                        $texterror = 'Sửa thất bại';
                    }
                } else {
                    $texterror = 'Vui lòng kiểm tra lại dữ liệu nhập vào';
                }

                redirect(base_url() . 'index.php/admin/test?msg=' . $texterror);
            }
        } else {
            
        }
        $this->load->library('form_validation');
        $this->load->view('template/header', $user);
        $this->load->view('admin_edit_test', $data);
        $this->load->view('template/footer');
    }

    public function delete_test($id) {
        $texterror = '';
        $session_data = $this->session->userdata('logged_in');
        $user['usersname'] = $session_data['usersname'];
        $user['groupid'] = $session_data['groupid'];
        $delete = $this->admin_model->delete_test($id, 20);
        if ($delete == true) {
            $texterror = 'Xóa thành công';
        } else {
            $texterror = 'Xóa thất bại';
        }
        redirect(base_url() . 'index.php/admin/test?msg=' . $texterror);
    }
    

    public function result() {
        echo 'Manager result';
    }

}
