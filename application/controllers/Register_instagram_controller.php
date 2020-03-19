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
		// if(!isset($_GET['code'])){
		// 	exit;
		// }

		// $settings = array(
		// 	"clientID" => INSTAGRAM_APP_ID,
		// 	"clientSecret" => INSTAGRAM_APP_SECRET,
		// 	"redirectURI" => INSTAGRAM_REDIRECT_URI,
		// );

		// $Instagram = new InstagramAPI($settings);

		// $data = $Instagram->getAccessTokenAndUserDetails($_GET['code']);

		// $access_token = "";
		// $params = array(
		// 	'get_code' => isset( $_GET['code'] ) ? $_GET['code'] : '',
		// );

		// $ig = new instagram_basic_display_api($params);
		// if($ig->hasUserAccessToken)
		// {
		// 	$access_token = $ig->getUserAccessToken();
		// }

		// $postCommentEndpoint = ENDPOINT_BASE.INSTAGRAM_APP_ID.'/comments';
		// $postCommentIgParams = array(
		// 	'message' => 'Commenting from IG Graph API!! :)',
		// 	'access_token' => $access_token
		// );
		// $postCommentResponseArray = $this->makeApiCall( $postCommentEndpoint, 'POST', $postCommentIgParams );
		// echo '<pre>';

		// die(print_r($postCommentResponseArray));
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