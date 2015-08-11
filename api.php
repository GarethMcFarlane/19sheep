<html>
 <head>
  <title>Misfit API Test</title>
 </head>
 <body>
		<?php
		
	
		require('OAuth2/Client.php');
		require('OAuth2/GrantType/IGrantType.php');
		require('OAuth2/GrantType/AuthorizationCode.php');
		
	

		
		const CLIENT_ID     = 'RF0wJW9jp545n3OH';
		const CLIENT_SECRET = 'BPHvRsX9wUo8286tbP2RIeweJ4Wyv7g9';

		const REDIRECT_URI           = 'http://garethmcfarlane.net/api.php';
		const AUTHORIZATION_ENDPOINT = 'https://api.misfitwearables.com/auth/dialog/authorize';
		const TOKEN_ENDPOINT         = 'https://api.misfitwearables.com/auth/tokens/exchange';
		
		$client = new OAuth2\Client(CLIENT_ID,CLIENT_SECRET);
		if (!isset($_GET['code'])) {
			$scope = array('scope' => 'public,birthday,email');
			$auth_url = $client->getAuthenticationUrl(AUTHORIZATION_ENDPOINT,REDIRECT_URI,$scope); 
			header('Location: ' . $auth_url);
			die('Redirect');
		} else {
			$params = array('code' => $_GET['code'], 'redirect_uri' => REDIRECT_URI);
			$response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
			$token = $response['result']['access_token'];
			$client->setAccessToken($token);
			$response = $client->fetch('https://api.misfitwearables.com/move/resource/v1/user/me/profile');

			}
		?>
 </body>
</html>