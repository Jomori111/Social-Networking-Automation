<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'../vendor/twitter/abraham/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;

class Publish_twitter_controller extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('General_m');
		
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$post_data = array();
		$twitter_info = array();

		$id = $this->session->userdata()['post_id'];
		$post_data = $this->General_m->get_post_content($id);
		$social_info = $this->General_m->get_company_social_info($post_data[0]['company']);
		$additional = $this->General_m->get_additional_text();
		$count = count($additional)-1;
		$rand = rand(0,$count);
		$message = $post_data[0]['message']." ".$post_data[0]['addon']." ".$additional[$rand]['twitter'];
		// die(print_r($post_data));
		$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_KEY_SECRET, $social_info[0]['twitter_token'],  $social_info[0]['twitter_token_secret']);
		$connection->setTimeouts(10, 15);

		$content = $connection->get("account/verify_credentials");
		$link = $post_data[0]['link'];
		$hash = $post_data[0]['hash'];

		$message = $message." ".$link." #".$hash;
		$tweetWM = $connection->upload('media/upload',['media' => $post_data[0]['path']]);
		$statues = $connection->post("statuses/update", 
			['media_ids' =>$tweetWM->media_id, 
			// 'attachment_url' => $link, 
			// 'entities' => ['hashtags' => $post_data[0]['hash']], 
			'status' => $message]);
		$tweets = $connection->get('statuses/home_timeline',['count' => 5, 'exclude_replies' => true]);
		// redirect("post_list_controller");
		redirect("publish_facebook_controller");
		

	}
		
}
