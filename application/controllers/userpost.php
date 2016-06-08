<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);
ini_set('memory_limit','2048M');
class Userpost extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('post_model', '', TRUE);
        $this->load->library('upload');
        $this->load->library('s3');
        $this->load->helper('form');
   	}
	public function imgvid()
	{
		S3::setAuth('ACCESS KEY', 'SECRET KEY');
		$allowed =  array('gif','jpg','png','avi','flv','wmv','mp4');
		$error = array();
		$post_media = array();
	    $is_error = 0;
	    $file = $_FILES;
	    foreach ($file as $file) {
	    	$ext = pathinfo(strtolower($file['name']), PATHINFO_EXTENSION);
	    	if ($file['error'] != 0) {
	    		$is_error = 1;
	    		array_push($error, "No image selected");
	    	} else if(!in_array($ext,$allowed)) {
	    		$is_error = 1;
	    		array_push($error, "File type must be image or video");
	    	} else if($file['size'] > 2097152) {
	    		$is_error = 1;
	    		array_push($error, "File size must be less then 2Mb");	
	    	} else if(sizeof($error) == 0) {
	    		$uri = time().".".$ext;
	    		if (S3::putObject(S3::inputFile($file['tmp_name']), 'krunalupload', $uri, S3::ACL_PUBLIC_READ)) {
	    			array_push($post_media, $uri);
			    } else {
			    	$is_error = 1;
			        array_push($error, "Error while uploading to s3");
			        $this->session->set_flashdata('errorImage', $error);
			        redirect('timeline');
			    }
	    	}
	    	if(!$is_error){
		    	$this->post_model->do_post($post_media);
		    	$this->session->set_flashdata('success', "Post uploaded successfully");
		    }
	    	$this->session->set_flashdata('errorImage', $error);
	    	redirect('timeline');
	    }
	}
    public function images()
	{
		S3::setAuth('AKIAJJS5GJ2Q2MTM2C6A', 'OEUgQ5y6hRKQXUgtg87Ov+s1/q1F0YALd4yPFWzd');
		$allowed =  array('gif','jpg','png');
		$error = array();
		$post_media = array();
	    $is_error = 0;
	    $file = $_FILES;
	    $count = count($file['images']['name']);
	    for ($i=0; $i < $count; $i++) {
	    	$ext = pathinfo(strtolower($file['images']['name'][$i]), PATHINFO_EXTENSION);
	    	if ($file['images']['error'][$i] != 0) {
	    		$is_error = 1;
	    		array_push($error, "No image selected");
	    	} else if(!in_array($ext,$allowed)) {
	    		$is_error = 1;
	    		array_push($error, "File type must be image or video");
	    	} else if($file['images']['size'][$i] > 2097152) {
	    		$is_error = 1;
	    		array_push($error, "File size must be less then 2Mb");	
	    	} else if(sizeof($error) == 0) {
	    		$uri = time().".".$ext;
	    		if (S3::putObject(S3::inputFile($file['images']['tmp_name'][$i]), 'krunalupload', $uri, S3::ACL_PUBLIC_READ)) {
	    			array_push($post_media, $uri);
			    } else {
			    	$is_error = 1;
			        array_push($error, "Error while uploading to s3");
			        $this->session->set_flashdata('errorImage', $error);
			        redirect('timeline');
			    }
	    	}
	    }
	    if(!$is_error){
	    	$this->post_model->do_post($post_media);
	    	$this->session->set_flashdata('success', "Post uploaded successfully");
	    }
    	$this->session->set_flashdata('errorImage', $error);
    	redirect('timeline');
	}
}?>