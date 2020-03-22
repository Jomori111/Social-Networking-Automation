<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/guzzle/autoload.php';
require_once APPPATH.'../vendor/zoonman/autoload.php';
use GuzzleHttp\Client;

class Builder_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['company'] = $this->General_m->get_company_list();
		$data['image'] = $this->General_m->get_company_image();
		$data['message'] = $this->General_m->get_company_message($data['company'][0]['id']);
		$data['link'] = $this->General_m->get_company_link($data['company'][0]['id']);
		$data['addon'] = $this->General_m->get_company_addon($data['company'][0]['id']);
		$data['hash'] = $this->General_m->get_company_hash($data['company'][0]['id']);

		$this->load->view('frontend/builder_view',$data);
	}

	public function upload_company_image()
	{
        $data = array();
		$data['id'] = $this->input->post("id");

		$upload_path = 'assets/image/';
		$tmp_name = $_FILES['upload_company_image']['tmp_name'];
        
		$name = date("Y-m-d:h:i:s");
        $name = $name.$_FILES['upload_company_image']['name'];

		$data['file'] = $upload_path.$name;
		move_uploaded_file($tmp_name,$upload_path.$name);

		$result = $this->General_m->upload_company_name($data);
		$result = json_encode($result);

		echo $result;
	}

	public function save_new_message()
	{
		$id = $this->input->post("id");
		$message = $this->input->post("message");
		$name = $this->input->post("name");
		$data = $this->General_m->save_new_message($id,$message,$name);
		$data = json_encode($data);
		echo $data;
	}

	public function save_new_addon()
	{
		$id = $this->input->post("id");
		$message = $this->input->post("message");
		$name = $this->input->post("name");
		$data = $this->General_m->save_new_addon($id,$message,$name);
		$data = json_encode($data);
		echo $data;
	}

	public function save_new_link()
	{
		$id = $this->input->post("id");
		$new_nick = $this->input->post("new_nick");
		$new_link = $this->input->post("new_link");
		$data = $this->General_m->save_new_link($id,$new_nick,$new_link);
		$data = json_encode($data);
		echo $data;
	}

	public function save_new_hash()
	{
		$id = $this->input->post("id");
		$hash = $this->input->post("hash");
		$name = $this->input->post("name");
		$data = $this->General_m->save_new_hash($id,$hash,$name);
		$data = json_encode($data);
		echo $data;
	}

	public function get_link_by_id()
	{
		$id = $this->input->post("id");
		$data = $this->General_m->get_link_by_id($id);
		$data = json_encode($data);
		echo $data;
	}

	public function save_post()
	{
		$company = $this->input->post("company");
		$image = $this->input->post("image");
		$message = $this->input->post("message");
		$link = $this->input->post("link");
		$nick = $this->input->post("nick");
		$addon_message = $this->input->post("addon_message");
		$hash = $this->input->post("hash");
		
		$data['save']= $this->General_m->save_post($company,$image,$message,$link,$nick,$addon_message,$hash);

		$this->load->helper("publish");
		// $data['twitter'] = publish_to_twitter();
		// $data['facebook'] = publish_to_facebook();
		$data['linkedin'] = publish_to_linkedin();
		
		$data = json_encode($data);
		echo $data;
	}

}
