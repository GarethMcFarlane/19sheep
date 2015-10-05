<?php
//Get remote host IP and append to API url.
$ip  = $_SERVER['REMOTE_ADDR'];
$url = 'http://ip.pycox.com/json/' . $ip;

//Initiate curl session and get data.
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$data = curl_exec($curl);
curl_close($curl);

//Decode returned data to JSON and get the time_zone field.
$json = json_decode($data);
$timezone = $json->{'time_zone'};

//Create a new DateTime using the timestamp.
$now = date_create('now', timezone_open($timezone));

//Calculate the offset in seconds from the given time zone.  
$offset = date_offset_get($now);

?>