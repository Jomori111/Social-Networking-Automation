<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/instagram/facebook/graph-sdk/src/Facebook/autoload.php';
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Publish_facebook_controller extends CI_Controller {

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
		

		$post_data = array();
		$twitter_info = array();

		$id = $this->session->userdata()['post_id'];
		$post_data = $this->General_m->get_post_content($id);
		$social_info = $this->General_m->get_company_social_info($post_data[0]['company']);
		$additional = $this->General_m->get_additional_text();
		$count = count($additional)-1;
		$rand = rand(0,$count);
		$message = $post_data[0]['message']." ".$post_data[0]['addon']." ".$additional[$rand]['twitter'];


		$token = $social_info[0]['facebook']['token'];
		// die(print_r($token));
		$url = "https://graph.facebook.com/v6.0/me/accounts?access_token={$token}";
		$headers = array("Content-type: application/json");
			 
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 curl_setopt($ch, CURLOPT_URL, $url);
	         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		 curl_setopt($ch, CURLOPT_COOKIEJAR,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_COOKIEFILE,'cookie.txt');  
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.3) Gecko/20070309 Firefox/2.0.0.3"); 
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		   
		 $st=curl_exec($ch); 
		 $result=json_decode($st,TRUE);
		 foreach ($result['data'] as $item) {
	 		$param = array(
			   'url' => 'https://cdn.joinhoney.com/images/landing/paypal/header-img-no-logo.png',
			 	 'access_token' => $item['access_token'],
			 	 'message' => $message
			);
			$ch = curl_init();
			$url = "https://graph.facebook.com/".$item['id']."/photos";
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
			$response = curl_exec($ch);
			$err = curl_error($ch);
			curl_close($ch);
			if ($err) {
			 echo "this is error".$err;
			} else {
			 echo $response;
			}

		}
	}
}
