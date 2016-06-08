<?php
class User extends \user
{
	private $userDetail = array('user_id' => 1,'user_email' => 'a@b.c', 'user_name'=> 'krunal', 'user_fb_id'='123456');
	private $is_email = false;
	public function __construct()
	{
	}
	public function login(){
		return $this->userDetail;
	}
	public function fblogin($id=''){
		return $this->userDetail;
	}
	public function is_email($email=''){
		return $this->is_email;
	}
	public function add_user(){
	}
	public function get_user(){
		return $this->is_email;
	}
	public function update_user($id=''){
	}
}
?>