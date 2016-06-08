<?php
Class User extends CI_Model
{
    function login($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_meta', 'user.user_id = user_meta.user_id');
        $this->db->where('user.user_email', $username);
        $this->db->where('user.user_password', MD5($password));
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    function fblogin($profile)
    {
        $this->db->select('*');
        $this->db->from('user_meta');
        $this->db->where('user_fb_id', $profile['id']);
        $this->db->limit(1);
        
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            $data = array(
                'user_email' => $profile['id'],
                'user_password' => ''
            );
            $this->db->insert('user',$data);
            $id = $this->db->insert_id();
            $data1 = array(
                'user_id' => $id,
                'user_name' =>  $profile['first_name'].' '.$profile['last_name'],
                'gender' => $profile['gender'],
                'user_fb_id' => $profile['id']
            );
            $this->db->insert('user_meta',$data1);
            return array('user_id'=>$id,'user_fb_id'=>$profile['id'], 'user_name'=>$profile['first_name'].' '.$profile['last_name']);
        }
    }
    function is_email($email) {
        $this->db->select('user_id, user_email');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $query = $this->db->get();
        
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    function add_user(){
        $data = array(
            'user_email' => $this->input->post('email'),
            'user_password' => MD5($this->input->post('password'))
        );
        $this->db->insert('user',$data);
        $id = $this->db->insert_id();
        $data1 = array(
            'user_id' => $id,
            'user_name' =>  $this->input->post('username')
        );
        $this->db->insert('user_meta',$data1);
    }
    function get_user($id) {
        $data = array();

        $this->db->select('*');
        $this->db->from('user_meta');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->result_array();;
        }    
    }
    function update_user($id) {
        $data = array(
            'user_gender' => $this->input->post('gender'),
            'user_dob' => $this->input->post('dob'),
            'user_number' => $this->input->post('number'),
            'user_hometown' => $this->input->post('ht')
        );
        $this->db->where('user_id', $id);
        $this->db->update('user_meta', $data);
    }
}
?>