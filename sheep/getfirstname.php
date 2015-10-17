<?php 
	session_start();
	require_once("functions.php");
	$qurey = ("SELECT fullName FROM users WHERE (email = :email)");
	$qurey_params = array(':email' => $_SESSION['email']);
	
	try {
		$stmt = $db->prepare($qurey);
		$result = $stmt->execute($qurey_params);
	} catch (PDOException $ex) {
		die("Failed to run qurey: " . $ex->getMessage());
	}
	$row = $stmt->fetch();

	$name = explode(" ", $row['fullName']);
	echo $name[0];
?>