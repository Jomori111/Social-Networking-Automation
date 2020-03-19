<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'../vendor/twitter/register_token/twitteroauth.php';

class Post_list_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		
		$data['list'] = $this->General_m->get_post_data();
		$this->load->view("frontend/post_list_view",$data);
	}

	public function save_selected_post()
	{
		$id = $this->input->post("id");
		$this->session->set_userdata("selected_post",$id);
		$data = $this->General_m->get_post_content($id);
		$data = json_encode($data);
		echo $data;
	}
		
}
