<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('user', '', TRUE);
        $this->load->library('form_validation');
        $this->load->helper('form');
   	}
	public function index() {
		$this->load->helper(array('form'));
		$data = array('title' => "Login | Signin");
		$this->load->view('header',$data);
		$this->load->view('signin_view');
		$this->load->view('footer');
	}
	public function validate() {
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email|callback_check_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $this->user->add_user();
        }
	}
	function check_email($email) {
		$result = $this->user->is_email($email);
		if ($result) {
			$this->form_validation->set_message('check_email', 'Email address already exist');
            return false;
		} else {
			return true;
		}
	}
	function update_user() {
		$name = $this->session->userdata('login_detail');
		$this->user->update_user($name['user_id']);
		redirect('timeline');
	}
}?>