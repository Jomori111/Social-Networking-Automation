<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/twitter/register_token/twitteroauth.php';
require_once APPPATH.'../vendor/instagram/facebook/graph-sdk/src/Facebook/autoload.php';
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// use GuzzleHttp\Client;

class Admin_company extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$data['company'] = $this->General_m->get_company_list();
		// die(print_r($this->session->userdata("company")));
		$this->load->view('backend/company_view',$data);
	}

	public function get_company_list()
	{
		$data = $this->General_m->get_company_list();
		$data = json_encode($data);
		echo $data;
	}

	public function update_company_name()
	{
		parse_str(file_get_contents("php://input"),$_PUT);
		$data = array();
		$data['id'] = $_PUT['id'];
		$data['name'] = $_PUT['name'];
		$data = $this->General_m->update_company_name($data);
		$data = json_encode($data);
		echo $data;
	}

	public function insert_company()
	{
		$name = $this->input->post("name");
		$data = $this->General_m->insert_company($name);
		$data = json_encode($data);
		echo $data;
	}

	public function get_company_social_info()
	{
		$id = $this->input->post("id");
		$this->session->set_userdata("company",$id);
		$this->session->set_userdata("status","backend");
		$data = $this->General_m->get_company_social_info($id);
		$data = json_encode($data);
		echo $data;
	}

	public function verify_twitter()
	{
		$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_KEY_SECRET);
   		$request_token = $connection->getRequestToken(REDIRECT_TWITTER_URI);

   		$token = $request_token['oauth_token'];
   		
	    $this->session->set_userdata('oauth_token',$token); 
	    $this->session->set_userdata('oauth_token_secret',$request_token['oauth_token_secret']);

	    switch ($connection->http_code) {
	      case 200:
	        $url = $connection->getAuthorizeURL($token);
	        header('Location: ' . $url); 
	        break;
	      default:
	        echo 'Could not connect to Twitter. Refresh the page or try again later.';
	    }
	}

	public function verify_facebook()
	{

		$appId         = FACEBOOK_APP_ID; //Facebook App ID
		$appSecret     = FACEBOOK_APP_SECRET; //Facebook App Secret
		$redirectURL   = FACEBOOK_REDIRECT_URI; //Callback URL
		$fbPermissions = array('email', 'public_profile'); //Facebook permission

		$fb = new Facebook(array(
		    'app_id' => $appId,
		    'app_secret' => $appSecret,
		    'default_graph_version' => 'v5.0',
		));

		$helper = $fb->getRedirectLoginHelper();

	    $fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
	    echo '<a href="'.$fbLoginURL.'">ww</a>';
	}
}
