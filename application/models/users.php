<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Users extends CI_Model {

    function login($user, $password) {
        $this->db->where('user_name', $user);
        $this->db->where('user_passhash', $password);
        $this->db->from('users');
        $this->db->join('groups_users', 'groups_users.userid = users.userid');
        $this->db->limit(1);
        $this->db->select('users.userid,user_name,user_email,groupid');
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function check_info($info, $user) {
        $this->db->where($info, $user);
        $this->db->from('users');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    function insert_user($username, $password, $email, $class, $fullname) {
        $datainsert = array(
            'user_name' => $username,
            'user_passhash' => $password,
            'user_email' => $email,
            'user_enabled' => 1,
            'user_class'=> $class,
            'user_title' => $fullname,
            'user_joindate' => time(),
        );
        $queryinsertuser = $this->db->insert('users', $datainsert);
        if ($queryinsertuser) {
            $this->db->where('user_name', $username);
            $this->db->from('users');
            $this->db->limit(1);
            $this->db->select('userid');
            $queryuser = $this->db->get();
            $queryusertmp = $queryuser->result();
            foreach ($queryusertmp as $row) {
                $userid = $row->userid;
                $datainsertgroup = array(
                    'userid' => $userid,
                    'groupid' => 4,
                );
                $query = $this->db->insert('groups_users', $datainsertgroup);
            }
        }
        return $query;
    }
    
    function getgroup (){
        $this->db->from('groups');
        $this->db->select('groupid,group_name');
        $query = $this->db->get();
        return $query->result();
    }
    
    function getuserbyid($id){
        $this->db->where('userid',$id);
        $this->db->from('users');
        $this->db->select('userid,user_name,user_email,user_title,user_enabled');
        $query = $this->db->get();
        return $query->result();
    }
    
    function updateuser($id,$user_title,$email,$groupid,$isactive){
        $this->db->set('a.user_email',$email);
        $this->db->set('a.user_enabled',$isactive);
        $this->db->set('a.user_title',$user_title);
        $this->db->set('b.groupid',$groupid);
        $this->db->where('a.userid', $id);
        $this->db->where('b.userid',$id);
        $query = $this->db->update('users as a , groups_users as b');
        return $query->result();

    }
    
    function getclass(){
        $this->db->from('class');
        $this->db->select('classid,class_name');
        $query = $this->db->get();
        return $query->result();
    }
    
    
}
