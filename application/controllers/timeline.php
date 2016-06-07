<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();

        $this->load->model('user', '', TRUE);

        $this->load->model('post_model', '', TRUE);

        $this->load->library('form_validation');

        $this->load->helper('form');
   	}
   	public function index() {
   		if ($this->session->userdata('login_detail') === null) {
			 redirect('/login');
    	}    
   		$name = $this->session->userdata('login_detail');
  		$head = array('title' => "Timeline | ".$name['user_name']);
  		$data_tlh = array('user' => $this->user->get_user($name['user_id']));
      $data_post = array('post' => $this->post_model->get_post($name['user_id']));
  		$this->load->view('header',$head);
      $this->load->view('timeline_header',$data_tlh);
  		$this->load->view('timeline_view',$data_post);
  		$this->load->view('footer');
   	}
}?>