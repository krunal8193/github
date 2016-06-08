<?php

class login extends \login
{
	public $redirected = '';
	public function __construct() {
		
	}
	public function _redirect($contraler){
		$this->redirected = $contraler;
	}
}


?>