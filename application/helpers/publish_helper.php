<?php
	require_once APPPATH.'../vendor/instagram/facebook/graph-sdk/src/Facebook/autoload.php';
	require_once APPPATH.'../vendor/twitter/abraham/autoload.php';
	require_once APPPATH.'../vendor/guzzle/autoload.php';
	require_once APPPATH.'../vendor/zoonman/autoload.php';

	use Abraham\TwitterOAuth\TwitterOAuth;
	use Facebook\Facebook;
	use Facebook\Exceptions\FacebookResponseException;
	use Facebook\Exceptions\FacebookSDKException;
	use GuzzleHttp\Client;

	function publish_to_twitter()
	{
		$CI = &get_instance();
		$CI->load->model("General_m");

		$post_data = array();
		$twitter_info = array();

		$id = $CI->session->userdata('post_id');

		$post_data = $CI->General_m->get_post_content($id);
		$social_info = $CI->General_m->get_company_social_info($post_data[0]['company']);

		if($social_info[0]['twitter_token'] == "")
		{
			return array("success"=>0, "msg"=>"No Access token");
		}

		$additional = $CI->General_m->get_additional_text();
		$count = count($additional)-1;
		$rand = rand(0,$count);
		$message = $post_data[0]['message']." ".$post_data[0]['addon']." ".$additional[$rand]['twitter'];
		// die(print_r($post_data));
		$connection = new TwitterOAuth(TWITTER_CONSUMER_KEY,TWITTER_CONSUMER_KEY_SECRET, $social_info[0]['twitter_token'],  $social_info[0]['twitter_token_secret']);
		$connection->setTimeouts(10, 15);

		$content = $connection->get("account/verify_credentials");
		$link = $post_data[0]['link'];
		$message = $message." ".$link;
		$hash = $post_data[0]['hash'];

		$hash_array = explode(",",$hash);
		for($i = 0; $i < count($hash_array); $i ++)
		{
			$message = $message." #".$hash_array[$i];
		}
		$tweetWM = $connection->upload('media/upload',['media' => $post_data[0]['path']]);
		$statues = $connection->post("statuses/update", 
			['media_ids' =>$tweetWM->media_id, 
			'status' => $message]);
		$tweets = $connection->get('statuses/home_timeline',['count' => 5, 'exclude_replies' => true]);

		return array("success"=>1, "msg"=>"Access token");
	}

	function publish_to_facebook()
	{
		$CI = &get_instance();
		$CI->load->model("General_m");

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

		$id = $CI->session->userdata()['post_id'];
		$post_data = $CI->General_m->get_post_content($id);
		$social_info = $CI->General_m->get_company_social_info($post_data[0]['company']);

		if($social_info[0]['facebook_token'] == "")
		{
			return array("success"=>0, "msg"=>"No Access token");
		}
		$additional = $CI->General_m->get_additional_text();
		$count = count($additional)-1;
		$rand = rand(0,$count);
		$message = $post_data[0]['message']." ".$post_data[0]['addon']." ".$additional[$rand]['facebook'];
		$link = $post_data[0]['link'];
		$message = $message." ".$link;

		$hash = $post_data[0]['hash'];

		$hash_array = explode(",",$hash);
		for($i = 0; $i < count($hash_array); $i ++)
		{
			$message = $message." #".$hash_array[$i];
		}

		$token = $social_info[0]['facebook_token'];
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
			
			return array("success"=>1, "msg"=>"Access token");

		 }
		
	}

	function publish_to_instagram()
	{
		
	}

	function publish_to_linkedin()
	{
		$CI = &get_instance();
		$CI->load->model("General_m");

		$company = $CI->session->userdata("company");
		$status = $CI->session->userdata("status");
		$post_id = $CI->session->userdata("post_id");

		$data = $CI->General_m->get_post_content($post_id);
		$linkedin_info = $CI->General_m->get_company_social_info($data[0]['company']);

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


?>