<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public $fbuser = "";
    
    public function __construct()
    {
        parent::__construct();
        
        // Load facebook library and pass associative array which contains appId and secret key
        $this->load->library('facebook', array(
            'appId' => 'YOUR APP Id',
            'secret' => 'YOUR SECRET KEY'
        ));
        
        // Get user's login information
        $this->fbuser = $this->facebook->getUser();

        $this->load->model('user', '', TRUE);
        
        $this->load->library('form_validation');
        
        $this->load->helper('form');
   	}

	public function index() {
        if (isset($_SESSION['login_detail'])) {
            redirect('timeline');
        }
		$this->load->helper(array('form'));
		$data = array('title' => "Login | Signin");
		$this->load->view('header',$data);
		$this->load->view('login_view');
		$this->load->view('footer');
	}
	public function verifyLogin() {
    	if($this->input->post('username') !== null && $this->input->post('password') !== null){
        	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_idpass');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                redirect('timeline');
            }
        } else {
            redirect('timeline');
        }
	}
	function check_idpass($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');
        
        //query the database
        $result = $this->user->login($username, $password);
        
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'user_id' => $row->user_id,
                    'user_email' => $row->user_email,
                    'user_name' => $row->user_name
                );
                $this->session->set_userdata('login_detail', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_idpass', 'Invalid username or password');
            return false;
        }
    }
    public function logout(){
    	$this->session->unset_userdata('login_detail');
    	redirect('login');
    }
    function loginfb(){
        if ($this->fbuser) {
            $data1['user_profile'] = $this->facebook->api('/me/');
            
            // Get logout url of facebook
            $data1['logout_url'] = $this->facebook->getLogoutUrl(array(
                'next' => base_url() . 'index.php/login/logout'
            ));
            checkFbUser($data1['user_profile']);
            redirect('timeline');
        } else {
            $login_url = $this->facebook->getLoginUrl();
            redirect($login_url);
        }
    }
    function checkfbuser($profile){
    	$result = $this->user->fblogin($profile);
        if ($result) {
            $sess_array = array();
            foreach ($result as $row) {
                $sess_array = array(
                    'user_id' => $row->user_id,
                    'user_fb_id' => $row->user_fb_id,
                    'user_name' => $row->user_name
                );
                $this->session->set_userdata('login_detail', $sess_array);
            }
            return TRUE;
        } else {
            $this->form_validation->set_message('check_idpass', 'Invalid username or password');
            return false;
        }
    }
}