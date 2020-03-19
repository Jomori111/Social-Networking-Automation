<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/guzzle/autoload.php';
require_once APPPATH.'../vendor/zoonman/autoload.php';
use GuzzleHttp\Client;

class Publish_linkedin_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$company = $this->session->userdata("company");
		$status = $this->session->userdata("status");
		$post_id = $this->session->userdata("post_id");

		$data = $this->General_m->get_post_content($post_id);
		$linkedin_info = $this->General_m->get_company_social_info($data[0]['company']);

		$access_token = $linkedin_info[0]['linkedin_token'];
		print_r($access_token);
		echo "<br>";
		$linkedin_profile_id = "";
		
		
		try {
		    $client = new Client(['base_uri' => 'https://api.linkedin.com']);
		    
		    $response = $client->request('GET', '/v2/me', [
		        'headers' => [
		            "Authorization" => "Bearer " . $access_token,
		        ],
		    ]);
		    $data = json_decode($response->getBody()->getContents(), true);
		    $linkedin_profile_id = $data['id'];

		    // $data = $this->General_m->save_company_linkedin_info($access_token,$linkedin_profile_id);
		    // redirect("admin_company");
		} catch(Exception $e) {
		    echo $e->getMessage();
		}


		$link = 'https://modernevites.com';
		$linkedin_id = $linkedin_profile_id;
		$body = new \stdClass();
		$body->content = new \stdClass();
		$body->content->contentEntities[0] = new \stdClass();
		$body->text = new \stdClass();
		$body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
		$body->content->contentEntities[0]->entityLocation = $link;
		$body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = "https://modernevites.com/assets/img/main_logo.png";
		$body->content->title = 'New Modern and Nice Digital Invitation';
		$body->owner = 'urn:li:person:'.$linkedin_id;
		$body->text->text = 'New modern and nice digital invitation platform has been launched. Please sign up and start send invitation for your business';
		$body_json = json_encode($body, true);
		
		try {
		    $client = new Client(['base_uri' => 'https://api.linkedin.com']);
		    $response = $client->request('POST', '/v2/shares', [
		        'headers' => [
		            "Authorization" => "Bearer " . $access_token,
		            "Content-Type"  => "application/json",
		            "x-li-format"   => "json"
		        ],
		        'body' => $body_json,
		    ]);
		 
		    if ($response->getStatusCode() !== 201) {
		        echo 'Error: '. $response->getLastBody()->errors[0]->message;
		    }
		 
		    echo 'Post is shared on LinkedIn successfully';
		} catch(Exception $e) {
		    echo $e->getMessage(). ' for link '. $link;
		}
	}
}
