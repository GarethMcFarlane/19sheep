
<html>
 <head>
  <title>Withings API Test</title>
 </head>
 <body>
		<?php

		session_start();


		//Generates random string for authentication
		function generateRandomString($length = 32) {
    		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		}

		$consumer_key = '4d3135853f4c5e07630fc130c34bd7440f1861844e00d96cd726d4f7513';
		$secret = '82180c760fd5504016d92f26bcc40c282fd4c831d6c7b6c21e09384496de74&';
		$time = explode(' ', microtime());
		$timestamp = $time[1];
		$callback = 'http://garethmcfarlane.net/api.php';
		$nonce = generateRandomString();
		$signature_method='HMAC-SHA1';
		$oauth_version = '1.0';


		//Checks if we are being redirected to from the authentication portal.
		if (!isset($_GET['oauth_token'])) {
			//Initialise curl request
			$curl = curl_init();
		
		//Parameters for base string construction.
		$requestTokenParameters = array (
			'oauth_callback' => $callback,
			'oauth_consumer_key' => $consumer_key,
			'oauth_nonce' => $nonce,
			'oauth_signature_method' => $signature_method,
			'oauth_timestamp' => $timestamp,
			'oauth_version' => $oauth_version
			);

		//Sorting, encoding base string in SHA1 with the app secret.
		ksort($requestTokenParameters);
		$base_string = oauth_get_sbs('GET','https://oauth.withings.com/account/request_token',$requestTokenParameters);
		$signature = urlencode(base64_encode(hash_hmac('sha1',$base_string,$secret,true)));
		
		//Getting data and storing it.  
		$url = "https://oauth.withings.com/account/request_token?oauth_callback=$callback&oauth_consumer_key=$consumer_key&oauth_nonce=$nonce&oauth_signature=$signature&oauth_signature_method=$signature_method&oauth_timestamp=$timestamp&oauth_version=$oauth_version";

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$resp = curl_exec($curl);
		parse_str($resp,$responsearray);
		curl_close($curl);


		//Recomputing random numbers, timestamp and initializing the token.
		$nonce = generateRandomString();
		$time = explode(' ', microtime());
		$timestamp = $time[1];
		$oauth_token = $responsearray['oauth_token'];
		$oauth_token_secret = $responsearray['oauth_token_secret'];


		//Setting parameters for base string.
		$authorizationParameters = array (
			'oauth_consumer_key' => $consumer_key,
			'oauth_nonce' => $nonce,
			'oauth_signature_method' => $signature_method,
			'oauth_timestamp' => $timestamp,
			'oauth_version' => $oauth_version,
			'oauth_token' => $oauth_token
			);

		//Creating secret key.
		$authorizationSecret = $secret . $oauth_token_secret;
		$_SESSION["authSecret"] = $authorizationSecret;
		ksort($authorizationParameters);
		//Making base string and encoding with sha1 and secret key.
		$base_string = oauth_get_sbs('GET','https://oauth.withings.com/account/authorize',$authorizationParameters);
		$signature = urlencode(base64_encode(hash_hmac('sha1',$base_string,$authorizationSecret,true)));

		//Redirecting user to Withing authentication endpoint.
		$url = "https://oauth.withings.com/account/authorize?oauth_consumer_key=$consumer_key&oauth_nonce=$nonce&oauth_signature=$signature&oauth_signature_method=$signature_method&oauth_timestamp=$timestamp&oauth_token=$oauth_token&oauth_version=$oauth_version";
		header('Location: ' . $url);
		

		//We already have an access token but need to authorise user's access.
		} else {

		$curl = curl_init();

		//Recomputing random numbers, timestamp and initializing the token.
		$nonce = generateRandomString();
		$time = explode(' ', microtime());
		$timestamp = $time[1];
		$oauth_token = $_GET['oauth_token'];
		$userid = $_GET['userid'];


		//Parameters for base string construction.
		$userTokenParameters = array (
			'oauth_consumer_key' => $consumer_key,
			'oauth_nonce' => $nonce,
			'oauth_signature_method' => $signature_method,
			'oauth_timestamp' => $timestamp,
			'oauth_version' => $oauth_version,
			'oauth_token' => $oauth_token
			);




		//Sorting, encoding base string in SHA1 with the app secret.
		ksort($userTokenParameters);
		$base_string = oauth_get_sbs('GET','https://oauth.withings.com/account/access_token',$userTokenParameters);
		$secret = $_SESSION["authSecret"];

		$signature = urlencode(base64_encode(hash_hmac('sha1',$base_string,$secret,true)));

		//Getting data and storing it.  
		

		$url = "https://oauth.withings.com/account/access_token?oauth_consumer_key=$consumer_key&oauth_nonce=$nonce&oauth_signature=$signature&oauth_signature_method=$signature_method&oauth_timestamp=$timestamp&oauth_token=$oauth_token&oauth_version=$oauth_version";
		//print($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$finalResp = curl_exec($curl);
		parse_str($finalResp,$responsearray);
		$oauth_token = $responsearray['oauth_token'];
		$oauth_token_secret = $responsearray['oauth_token_secret'];
		$oauth_user_id = $responsearray['userid'];


		//^ Store these in a database


		curl_close($curl);
		session_destroy();
		//Redirect back to home page.
		header('Location: ' . 'http://garethmcfarlane.net');
		}

		?>
 </body>
</html>