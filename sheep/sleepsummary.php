<?php

include("functions.php");


function generateRandomString($length = 32) {
    		return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
		}

function getSleepSummary($start,$end) {


$query = "SELECT OAuth_token, OAuth_token_secret, user_id
		  FROM users
		  WHERE username = :username
";

$query_params = array(
	':username' = $_SESSION["username"];
	);

		try {
            $stmt = $db->prepare($query);
            $result = $stmt->execute($query_params);
        } catch (PDOException $ex) {
            die("Failed to run query: " . $ex->getMessage());
        }
$row = $stmt->$fetch();


$oauth_token = '6055e2e44e974ed68c3b4634f6eb31d9b11f297bc979f4f6d99cb1b1';
$oauth_token_secret = '2161d8debb9b09544823634c353149c3ff123024e39cd269f6287b713e';
$userid = '8065394';
$consumer_key = '4d3135853f4c5e07630fc130c34bd7440f1861844e00d96cd726d4f7513';
$secret = '82180c760fd5504016d92f26bcc40c282fd4c831d6c7b6c21e09384496de74';
$time = explode(' ', microtime());
$timestamp = $time[1];
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
			'startdateymd' => $start,
			'enddateymd' => $end
			);


$curl = curl_init();

$hashSecret = $secret . '&' . $oauth_token_secret;

ksort($userTokenParameters);
$base_string = oauth_get_sbs('GET','https://wbsapi.withings.net/v2/sleep?action=getsummary',$userTokenParameters);
$signature = urlencode(base64_encode(hash_hmac('sha1',$base_string,$hashSecret,true)));


$url = "https://wbsapi.withings.net/v2/sleep?action=getsummary&startdateymd=$start&enddateymd=$end&oauth_consumer_key=$consumer_key&oauth_nonce=$nonce&oauth_signature=$signature&oauth_signature_method=$signature_method&oauth_timestamp=$timestamp&oauth_token=$oauth_token&oauth_version=$oauth_version";


		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$resp = curl_exec($curl);
		//parse_str($resp,$responsearray);

		print_r($resp);


		curl_close($curl);

	}

	getSleepSummary('2015-08-04','2015-09-03');
?>
