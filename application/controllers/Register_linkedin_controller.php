<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'../vendor/guzzle/autoload.php';
require_once APPPATH.'../vendor/zoonman/autoload.php';
use GuzzleHttp\Client;

class Register_linkedin_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$access_token = "";
		$linkedin_profile_id = "";
		try {
		    $client = new Client(['base_uri' => 'https://www.linkedin.com']);
		    $response = $client->request('POST', '/oauth/v2/accessToken', [
		        'form_params' => [
		                "grant_type" => "authorization_code",
		                "code" => $_GET['code'],
		                "redirect_uri" => LINKEDIN_REDIRECT_URI,
		                "client_id" => LINKEDIN_CLIENT_ID,
		                "client_secret" => LINKEDIN_CLIENT_SECRET,
		        ],
		    ]);
		    $data = json_decode($response->getBody()->getContents(), true);

		    // $client = new Client(['base_uri' => 'https://www.linkedin.com']);
		    // $response = $client->request('POST', '/oauth/v2/accessToken', [
		    //     'form_params' => [
		    //             "grant_type" => "refresh_token",
		    //             "refresh_token" => $data['access_token'],
		    //             "client_id" => LINKEDIN_CLIENT_ID,
		    //             "client_secret" => LINKEDIN_CLIENT_SECRET
		    //     ],
		    // ]);
		    // $data = json_decode($response->getBody()->getContents(), true);

		    // print_r($data);
		    // $access_token = $data['access_token']; 

		    $data = $this->General_m->save_company_linkedin_info($access_token,$data['expires_in']);

		} catch(Exception $e) {
		    echo $e->getMessage();
		}

		// $access_token = 'AQR0vcPq8APhkpl2gxDqjGUbDzux1Qsjy9S3g27oPavFo9wOohevLH0JdVA6ryHMzhgf7uALI_wg6dg4tl0NGpL760ER-sGoWOfuqpbZUl5Q_QNCrM6ReDrOrLHy0AQLyz7uXGq5K0v4XCOoEc9ARwUS_gWTyPvOBc57yduqiABVLroCWb_uFWalSJz1TQ&state=65Gi70RbH2';

		
	}
}
