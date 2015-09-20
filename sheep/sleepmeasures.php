<?php
session_start();



function generateRandomString($length = 32) {
    		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		}

function getSleepData($startdate, $enddate) {


		//Get these from the database after logging in the user
		$oauth_token = $_SESSION["OAuthToken"];
		$oauth_token_secret = $_SESSION["OAuthTokenSecret"];
		$userid = $_SESSION["userid"];



		$consumer_key = '4d3135853f4c5e07630fc130c34bd7440f1861844e00d96cd726d4f7513';
		$secret = '82180c760fd5504016d92f26bcc40c282fd4c831d6c7b6c21e09384496de74';
		$time = explode(' ', microtime());
		$timestamp = $time[1];
		$callback = 'http://garethmcfarlane.net/api.php';
		$nonce = generateRandomString();
		$signature_method='HMAC-SHA1';
		$oauth_version = '1.0';



		$userTokenParameters = array (
			'oauth_consumer_key' => $consumer_key,
			'oauth_nonce' => $nonce,
			'oauth_signature_method' => $signature_method,
			'oauth_timestamp' => $timestamp,
			'oauth_version' => $oauth_version,
			'oauth_token' => $oauth_token,
			'startdate' => $startdate,
			'enddate' => $enddate,
			'userid' => $userid
		);
		ksort($userTokenParameters);	

		$hashSecret = $secret . '&' . $oauth_token_secret;
		$base_string = oauth_get_sbs('GET','https://wbsapi.withings.net/v2/sleep?action=get',$userTokenParameters);
		$signature = urlencode(base64_encode(hash_hmac('sha1',$base_string,$hashSecret,true)));
		$url = "https://wbsapi.withings.net/v2/sleep?action=get&userid=$userid&startdate=$startdate&enddate=$enddate&oauth_consumer_key=$consumer_key&oauth_nonce=$nonce&oauth_signature=$signature&oauth_signature_method=$signature_method&oauth_timestamp=$timestamp&oauth_token=$oauth_token&oauth_version=$oauth_version";

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$resp = curl_exec($curl);
		curl_close($curl);


		return($resp);
}

//Get today.
$enddate = strtotime("today 09:00:00") - 36000; //Get GMT time at 9am - 10 hours for timezone.
$startdate = $enddate - 43200;
$day1 = getSleepData($startdate,$enddate);

$enddate = strtotime("yesterday 09:00:00") - 36000; //Get GMT time at 9am - 10 hours for timezone.
$startdate = $enddate - 43200;
$day2 = getSleepData($startdate,$enddate);

$enddate = strtotime("-2 days 09:00:00") - 36000; //Get GMT time at 9am - 10 hours for timezone.
$startdate = $enddate - 43200;
$day3 = getSleepData($startdate,$enddate);


echo("[$day1,$day2,$day3]");

?>
