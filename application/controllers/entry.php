<?php

class Entry extends CI_Controller {

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
            redirect(base_url() . 'user', 'refresh');
        } else {
            redirect(base_url() . 'user', 'refresh');
        }
    }

    public function show_entry() {
        $testid = $this->input->post('testid');
        $subjectid = $this->input->post('subjectid');
        $table = '';
        $num = 0;
        if ($testid != '' && $testid > 0) {
            $result = $this->quizz_model->getallinkjsonbytestid($testid);
            if ($result != 'No_data') {
                $table = '<tr class="' . $testid . '">';
                $table .= '<td colspan="5">';
                for ($i = 0; $i < count($result); $i++) {
                    $num = $num + 1;
                    $table .= '<p>Đề '.$num.': <a href="">' . $result[$i]->test_linkname . '</a></p>';
                }
                $table .= '</td>';
                $table .= '</tr>';
            } else {
                $result = $this->quizz_model->getallinkjson($subjectid);
                $table = '<tr class="' . $testid . '">';
                $table .= '<td colspan="5">';
                if ($result != 'No_data') {
                    for ($j = 0; $j < count($result); $j++) {
                        $table .= '<div class="checkbox">
                        <label>
                          <input name='.$testid.' value="'.$result[$j]->linkid.'" type="checkbox"> '.$result[$j]->test_linkname.'
                        </label>
                      </div>';
                    }
                    
                }
                $table .='<a href="javascript:void(0);" onclick="add_entry_test('. $testid .');" class="btn btn-primary">Add đề</a>';
                $table .='<input type="hidden" name="entry_'.$testid.' value=""';
                $table .= '</td></tr>';
                
            }
        } else {
            $table .= 'tr class="' . $testid . '"><td colspan="5">Không tồn tài kỳ kiểm tra nào.</td><tr>';
        }
        
        echo $table;
    }
    
function update_entry(){
    $entry = $this->input->post('val');
    $testid = $this->input->post('testid');
    $entry = explode('_',$entry);
    $arraydata = array();
    $array = array();
    for($i=0;$i<count($entry);$i++){
        if($entry[$i]!= ''){
            $array = array(
                "linkid"=>$entry[$i],
                "testid" =>$testid, 
            );
        }
        array_push($arraydata, $array);
    }
    array_shift($arraydata);
    $arraydata = json_encode($arraydata);
    $result = $this->quizz_model->updatetestidlinkjson($arraydata);  
    if($result){
        echo 1;die;
    }else {
        echo 0;die;
    }
}

}
?>

