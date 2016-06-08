<?php

/**
* 
*/
class Loader extends \CI_Loader
{
	public $view;
	public $viewData = array();

	public function __construct()
	{
		# code...
	}
	public function library($library = '', $params = null, $object_name = null){

	}
	public function view($view, $vars = array(), $return = FALSE) {
		$this->view = $view;
		$this->viewData = $vars;
	}
}

?>