<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/twitter/abraham/autoload.php';
require_once APPPATH.'../vendor/instagram/facebook/graph-sdk/src/Facebook/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Register_facebook_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$appId         = FACEBOOK_APP_ID; 
		$appSecret     = FACEBOOK_APP_SECRET; 
		$redirectURL   = FACEBOOK_REDIRECT_URI;
		$fbPermissions = array('email', 'public_profile'); 

		$fb = new Facebook(array(
		    'app_id' => $appId,
		    'app_secret' => $appSecret,
		    'default_graph_version' => 'v6.0',
		));

		$helper = $fb->getRedirectLoginHelper();
		$token = $helper->getAccessToken();
		$token = $token->getValue();
		$data = $this->General_m->save_company_facebook_info($token);
		redirect("admin_company");
		
	}
}
