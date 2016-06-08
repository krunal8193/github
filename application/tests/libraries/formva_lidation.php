<?php
/**
* 
*/
class FormValidation extends \CI_Validation
{
	public $valid = FALSE;
	public function __construct()
	{
		# code...
	}
	public function getRules(){
		return $this->_rules;
	}
	public function run(){
		return $this->valid;
	}
}
?>