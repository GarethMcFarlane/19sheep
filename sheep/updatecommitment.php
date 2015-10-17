<?php
session_start();
require_once("functions.php");

$query = ("UPDATE isachieved SET commitments WHERE (isachieved = 1)");
$query_params = array(':isachieved' => $_POST['isachieved']);

	try {
		$stmt = $db->prepare($query);
		$result = $stmt->execute($query_params);
	} catch (PDOException $ex) {
		die("Failed to run query: " . $ex->getMessage());
		exit();
	}
?>