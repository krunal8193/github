<?php
Class Post_model extends CI_Model
{
    function do_post($post_media) {
    	$desc = $this->input->post('desc');
    	$name = $this->session->userdata('login_detail');
    	$data = array(
            'user_id' => $name['user_id'],
            'post_desc' => $desc
        );
        $this->db->insert('post',$data);
        $id = $this->db->insert_id();

        foreach ($post_media as $media) {
        	$data = array(
	            'post_id' => $id,
	            'media_name' => $media
	        );
	        $this->db->insert('post_media',$data);
        }
    }
    function get_post($id) {
        $data = array();

        $this->db->select('*');
        $this->db->from('post');
        $this->db->where('user_id', $id);
        $this->db->order_by("post_time", "DESC");

        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                // array_push($data, array('time' => $row->post_time,'desc' => $row->post_desc));
                $this->db->select('*');
                $this->db->from('post_media');
                $this->db->where('post_id', $row->post_id);
                $query_media = $this->db->get();
                $media = array();
                if ($query_media->num_rows() > 0) {
                    foreach ($query_media->result() as $row_media) {
                        array_push($media, $row_media->media_name);
                    }
                }
                $post = array('time' => $row->post_time,'desc' => $row->post_desc, 'media' => $media);
                array_push($data, $post);
            }
        }
        return $data;    
    }
}