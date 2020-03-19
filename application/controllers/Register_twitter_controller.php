<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'../vendor/twitter/register_token/twitteroauth.php';

class Register_twitter_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		
		$oauth_token = $this->session->userdata("oauth_token");
		$oauth_token_secret = $this->session->userdata("oauth_token_secret");
		$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_KEY_SECRET, $oauth_token, $oauth_token_secret);
		
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

		$data = $this->General_m->save_company_twitter_info($access_token);
		$this->session->sess_destroy();
		redirect("admin_company");
	}
		
}
