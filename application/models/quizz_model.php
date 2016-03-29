<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Quizz_model extends CI_Model {

    private $limit = 0;
    private $idsubjects = 0;
    private $questsion = array();
    private $datainsert = array();
    private $testid = 0;
    private $userid = 0;

    function __construct() {
        parent::__construct();
    }

    function showquizz($limit) {
        $this->db->where('test_enabled = 1');
        $this->db->from('tests');
        $this->db->join('subjects', 'subjects.subjectid = tests.subjectid');
        $this->db->select('testid,test_name,test_time,test_instructions,subject_name,tests.subjectid');
        $this->db->limit($limit);
        $this->db->order_by("testid", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    function showquizzcate($idsubjects, $limit) {
        if ($idsubjects > 0) {
            $this->db->where('subjectid', $idsubjects);
        }
        $this->db->where('test_enabled = 1');
        $this->db->from('tests');
        //$this->db->join('subjects', 'subjects.'.$idsubjects.' = tests.'.$idsubjects.'');
        $this->db->select('testid,test_name,test_time,test_instructions,tests.subjectid');
        $this->db->limit($limit);
        $this->db->order_by("testid", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    function showsubject($idsubjects) {
        $this->db->where('subjectid', $idsubjects);
        $this->db->from('subjects');
        $this->db->select('subjectid,subject_name');
        $query = $this->db->get();
        return $query->result();
    }

    function showallsubject() {
        $this->db->from('subjects');
        $this->db->select('subjectid,subject_name');
        $query = $this->db->get();
        return $query->result();
    }

    function starttest($idtest) {
        $questsion = $this->showquestion($idtest);
        //echo '<pre>';
        //var_dump($questsion);die;
        $questiontext = array();
        for ($i = 0; $i < count($questsion); $i++) {
            $id = intval($questsion[$i]->questionid);
            array_push($questiontext, $this->showtextquestion($id));
            array_push($questiontext[$i], $this->showanswers($id));
        }
        return $questiontext;
    }

    function showquestion($idtest) {
        $this->db->where('testid', $idtest);
        $this->db->from('tests_questions');
        $this->db->select('questionid');
        $this->db->order_by('questionid', 'random');
        $query = $this->db->get();
        return $query->result();
    }

    function showtextquestion($idquestion) {
        $this->db->where('questionid', $idquestion);
        $this->db->from('questions');
        $this->db->select('questionid,question_text,question_type');
        $query = $this->db->get();
        return $query->result();
    }

    function showanswers($idquestion) {
        $this->db->where('questionid', $idquestion);
        $this->db->from('answers');
        $this->db->select('answerid,answer_text');
        $this->db->order_by("answerid", "random");
        $query = $this->db->get();
        return $query->result();
    }

    function showquizztest($testid) {
        $this->db->where('testid', $testid);
        $this->db->from('tests');
        $this->db->join('subjects', 'subjects.subjectid = tests.subjectid');
        $this->db->select('testid,test_name,test_time,test_instructions,subject_name,tests.subjectid,test_type,test_link,test_numanwsers,test_json');
        $query = $this->db->get();
        return $query->result();
    }

    function insertresult($idtest, $userid, $numtest,$linkid) {
        $datainsert = array(
            'testid' => intval($idtest),
            'userid' => intval($userid),
            'result_numtest' => intval($numtest),
            'result_datestart' => time(),
            'linkid' => $linkid,
        );
        if ($numtest == 1) {
            $this->db->insert('results', $datainsert);
        } else {
            $this->db->where('testid', $idtest);
            $this->db->where('userid', $userid);
            $this->db->where('linkid', $linkid);
            $this->db->update('results', $datainsert);
        }
    }

    function insertresultjson($idtest, $userid, $datajson, $result_points) {
        $this->db->where('testid', $idtest);
        $this->db->where('userid', $userid);
        $this->db->from('results');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $this->db->where('testid', $idtest);
            $this->db->where('userid', $userid);
            $datainsert = array(
                'result_json' => $datajson,
                'result_points' => intval($result_points),
                'result_timeexceeded' => time(),
            );
            $this->db->update('results', $datainsert);
        } else {
            $datainsert = array(
                'testid' => intval($idtest),
                'userid' => intval($userid),
                'result_json' => $datajson,
                'result_points' => intval($result_points),
                'result_timeexceeded' => time(),
            );
            $this->db->insert('results', $datainsert);
        }
    }

    function getnumtest($idtest, $userid) {
        $this->db->where('testid', $idtest);
        $this->db->where('userid', $userid);
        $this->db->from('results');
        $this->db->select('result_numtest,linkid');
        $query = $this->db->get();
        return $query->result();
    }

    function gettopresult() {
        $this->db->from('results');
        $this->db->join('tests', 'results.testid = tests.testid');
        $this->db->join('users', 'results.userid = users.userid');
        $this->db->limit(10);
        $this->db->select('tests.test_name,results.result_points,users.user_title');
        $this->db->order_by("tests.testid", "desc");
        $this->db->order_by("results.result_points", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    function getresultbysubject($subjectid) {
        $this->db->from('results');
        $this->db->join('tests', 'results.testid = tests.testid');
        $this->db->join('users', 'results.userid = users.userid');
        $this->db->limit(10);
        $this->db->select('tests.test_name,results.result_points,users.user_title');
        $this->db->order_by("tests.testid", "desc");
        $this->db->order_by("results.result_points", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    function insertlinkjson($test_linkname, $test_link, $test_numanwsers, $test_json, $subjectid) {
        $datainsert = array(
            'test_linkname' => $test_linkname,
            'test_numanwsers' => intval($test_numanwsers),
            'test_link' => $test_link,
            'test_json' => $test_json,
            'subjectid' => intval($subjectid),
        );
        $query = $this->db->insert('test_linkjson', $datainsert);
        return $query;
    }

    function updatelinkjson($linkid, $test_linkname, $test_numanwsers, $test_link, $test_json, $subjectid, $testid) {
        $this->db->where('linkid', $linkid);
        $datainsert = array(
            'test_linkname' => $test_linkname,
            'test_numanwsers' => intval($test_numanwsers),
            'test_link' => $test_link,
            'test_json' => $test_json,
            'subjectid' => intval($subjectid),
            'testid' => $testid,
        );
        $query = $this->db->update('test_linkjson', $datainsert);
        return $query;
    }
    
    function updatetestidlinkjson($dataupdate) {
        $this->db->trans_start();
        $dataupdate = json_decode($dataupdate);
        $this->db->update_batch('test_linkjson', $dataupdate,'linkid');
        $this->db->trans_complete();
        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;
    }

    function getlinkjsonbytestid($testid) {
        $this->db->where('testid', $testid);
        $this->db->from('test_linkjson');
        $this->db->select('linkid,test_link,test_json,test_numanwsers');
        $this->db->order_by("linkid", "random");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 'No_data';
        }
    }
    
    function getallinkjsonbytestid($testid) {
        $this->db->where('testid', $testid);
        $this->db->from('test_linkjson');
        $this->db->select('linkid,test_linkname');
        $this->db->order_by("linkid");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 'No_data';
        }
    }
    function getlinkbytestidlinkid($testid,$linkid) {
        $this->db->where('testid', $testid);
        $this->db->where('linkid', $linkid);
        $this->db->from('test_linkjson');
        $this->db->select('linkid,test_json,test_link,test_numanwsers');
        $this->db->order_by("linkid");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 'No_data';
        }
    }
    function getallinkjson($subjectid = 0) {
        $this->db->where('testid', 0);
        if($subjectid > 0){
            $this->db->where('subjectid', $subjectid);
        }       
        $this->db->from('test_linkjson');
        $this->db->select('linkid,test_linkname');
        $this->db->order_by("linkid");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 'No_data';
        }
    }


}
