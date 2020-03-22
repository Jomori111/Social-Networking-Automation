<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/instagram/InstagramAPI.php';
require_once APPPATH.'../vendor/instagram/Setaccesstoken.php';

class Register_instagram_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		if(!isset($_GET['code'])){
			exit;
		}

		$postCommentEndpoint = 'https://api.instagram.com/oauth/access_token';
		$postCommentIgParams = array(
			'client_id' => INSTAGRAM_APP_ID,
			'client_secret' => INSTAGRAM_APP_SECRET,
			'grant_type' => 'authorization_code',
			'redirect_uri' => 'https://localhost/blog/Register_instagram_controller',
			'code' => $_GET['code']
		);
		$postCommentResponseArray = $this->makeApiCall( $postCommentEndpoint, 'POST', $postCommentIgParams );
		echo '<pre>';

		$user_id = $postCommentResponseArray['user_id'];
		$token = $postCommentResponseArray['access_token'];

		$postCommentEndpoint = 'https://graph.instagram.com/access_token';
		$postCommentIgParams = array(
			'grant_type' => 'ig_exchange_token',
			'client_secret' => INSTAGRAM_APP_SECRET,
			'access_token' => $token
		);
		$postCommentResponseArray = $this->makeApiCall( $postCommentEndpoint, 'GET', $postCommentIgParams );


		$postCommentEndpoint = 'https://graph.facebook.com/'.$user_id.'/media';
		$postCommentIgParams = array(
			'image_url' => 'https://modernevites.com/assets/img/main_logo.png',
			'caption' => 'apple'
		);

		$postCommentResponseArray = $this->makeApiCall( $postCommentEndpoint, 'POST', $postCommentIgParams );

		die(print_r($postCommentResponseArray));
	}

	public function makeApiCall( $endpoint, $type, $params ) {
		$ch = curl_init();

		if ( 'POST' == $type ) {
			curl_setopt( $ch, CURLOPT_URL, $endpoint );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
			curl_setopt( $ch, CURLOPT_POST, 1 );
		} elseif ( 'GET' == $type ) {
			curl_setopt( $ch, CURLOPT_URL, $endpoint . '?' . http_build_query( $params ) );
		}

		curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

		$response = curl_exec( $ch );
		curl_close( $ch );

		return json_decode( $response, true );
	}
}