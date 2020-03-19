<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_list extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['company'] = $this->General_m->get_company_list();
		$this->load->view('backend/list_view',$data);
	}

	public function insert_message()
	{
		$id = $this->input->post("id");
		$message = $this->input->post("message");
		$data = $this->General_m->insert_message($id,$message);
		$data = json_encode($data);
		echo $data;
	}
	
	public function get_message_list()
	{
		$id = $this->input->post("id");
		$data = $this->General_m->get_company_message($id);
		$data = json_encode($data);
		echo $data;
	}

	public function update_message_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$data['id'] = $_PUT['id'];
		$data['message'] = $_PUT['message'];
		$data['name'] = $_PUT['name'];
		$data = $this->General_m->update_message_list($data);
		$data = json_encode($data);
		echo $data;
	}

	public function delete_message_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$id = $_PUT['id'];
		$data = $this->General_m->delete_message_list($id);
		$data = json_encode($data);
		echo $data;
	}

	public function insert_link()
	{
		$id = $this->input->post("id");
		$nick = $this->input->post("nick");
		$link = $this->input->post("link");
		$data = $this->General_m->insert_link($id,$nick,$link);
		$data = json_encode($data);
		echo $data;
	}

	public function get_link_list()
	{
		$id = $this->input->post("id");
		$data = $this->General_m->get_company_link($id);
		$data = json_encode($data);
		echo $data;
	}

	public function update_link_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$data['id'] = $_PUT['id'];
		$data['nick'] = $_PUT['nick'];
		$data['link'] = $_PUT['link'];

		$data = $this->General_m->update_link_list($data);
		$data = json_encode($data);
		echo $data;
	}

	public function delete_link_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$id = $_PUT['id'];
		$data = $this->General_m->delete_link_list($id);
		$data = json_encode($data);
		echo $data;
	}




	public function insert_hash()
	{
		$id = $this->input->post("id");
		$hash = $this->input->post("hash");
		$data = $this->General_m->insert_hash($id,$hash);
		$data = json_encode($data);
		echo $data;
	}
	
	public function get_hash_list()
	{
		$id = $this->input->post("id");
		$data = $this->General_m->get_company_hash($id);
		$data = json_encode($data);
		echo $data;
	}

	public function update_hash_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$data['id'] = $_PUT['id'];
		$data['hash'] = $_PUT['hash'];
		$data['name'] = $_PUT['name'];
		$data = $this->General_m->update_hash_list($data);
		$data = json_encode($data);
		echo $data;
	}

	public function delete_hash_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$id = $_PUT['id'];
		$data = $this->General_m->delete_hash_list($id);
		$data = json_encode($data);
		echo $data;
	}



	public function insert_addon()
	{
		$id = $this->input->post("id");
		$addon = $this->input->post("addon");
		$data = $this->General_m->insert_addon($id,$addon);
		$data = json_encode($data);
		echo $data;
	}
	
	public function get_addon_list()
	{
		$id = $this->input->post("id");
		$data = $this->General_m->get_company_addon($id);
		$data = json_encode($data);
		echo $data;
	}

	public function update_addon_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$data['id'] = $_PUT['id'];
		$data['addon'] = $_PUT['message'];
		$data['name'] = $_PUT['name'];
		$data = $this->General_m->update_addon_list($data);
		$data = json_encode($data);
		echo $data;
	}

	public function delete_addon_list()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$id = $_PUT['id'];
		$data = $this->General_m->delete_addon_list($id);
		$data = json_encode($data);
		echo $data;
	}

	public function add_additional_text()
	{
		$linkedin = $this->input->post("linkedin_text");
		$facebook = $this->input->post("facebook_text");
		$twitter = $this->input->post("twitter_text");
		$instagram = $this->input->post("instagram_text");
		$data = $this->General_m->add_additional_text($linkedin,$facebook,$twitter,$instagram);
		redirect("admin_list");

	}

}
