<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function delete_test($id) {
        $this->db->where('testid', $id);
        $query = $this->db->delete('tests');
        return $query;
    }

    function insert_test($test_name,$subjectid,$test_instructions,$test_time,$test_type,$test_link,$test_numanwsers,$datajson) {
        $datainsert = array(
            'test_name' => $test_name,
            'subjectid' => intval($subjectid),
            'test_type' => intval($test_type),
            'test_instructions' => $test_instructions,
            'test_time' => intval($test_time) * 60,
            'test_createdate' =>time(),
            'test_enabled' => 1,
            'test_link'=> $test_link,
            'test_numanwsers' => $test_numanwsers,
            'test_json' => $datajson,
        );
        $query = $this->db->insert('tests', $datainsert);
        return $query;
    }
    function update_test($id,$test_name,$subjectid,$test_instructions,$test_time,$test_type,$test_link,$test_numanwsers,$datajson) {
        $this->db->where('testid', $id);
        $this->db->from('tests');
        $querytmp = $this->db->get();
        if ($querytmp->num_rows() == 1) {
            $this->db->where('testid', $id);
            $datainsert = array(
                'test_name' => $test_name,
                'subjectid' => intval($subjectid),
                'test_type' => intval($test_type),
                'test_instructions' => $test_instructions,
                'test_time' => intval($test_time) * 60,
                'test_link'=> $test_link,
                'test_numanwsers' => $test_numanwsers,
                'test_json' => $datajson,
            );
            $query = $this->db->update('tests', $datainsert);
        }               
        return $query;
    }
    function listuser($limit){
        $this->db->where('user_enabled = 1');
        $this->db->from('users');
        $this->db->select('userid,user_name,user_title');
        $this->db->limit($limit);
        $this->db->order_by("userid", "desc");
        $query = $this->db->get();
        return $query->result();
    }
}
