<?php
session_start();


function generateRandomString($length = 32) {
    		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		}

function getActivityMeasures($startdateymd,$enddateymd) {

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
			'startdateymd' => $startdateymd,
			'enddateymd' => $enddateymd
			);


$curl = curl_init();

$hashSecret = $secret . '&' . $oauth_token_secret;

ksort($userTokenParameters);
$base_string = oauth_get_sbs('GET','https://wbsapi.withings.net/v2/measure?action=getactivity',$userTokenParameters);
$signature = urlencode(base64_encode(hash_hmac('sha1',$base_string,$hashSecret,true)));


$url = "https://wbsapi.withings.net/v2/measure?action=getactivity&startdateymd=$startdateymd&enddateymd=$enddateymd&oauth_consumer_key=$consumer_key&oauth_nonce=$nonce&oauth_signature=$signature&oauth_signature_method=$signature_method&oauth_timestamp=$timestamp&oauth_token=$oauth_token&oauth_version=$oauth_version";


		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$resp = curl_exec($curl);
		//parse_str($resp,$responsearray);

		return ($resp);

		curl_close($curl);

	}

	$enddate = date("Y-m-d");
	$startdate = date("Y-m-d", strtotime("-6 days"));


	echo getActivityMeasures($startdate,$enddate);

?>
