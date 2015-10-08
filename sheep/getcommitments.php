<?php
session_start();
require_once("functions.php");

$query = ("SELECT * FROM commitments WHERE (email = :email)");
$query_params = array(':email' => $_SESSION['email']);

	try {
		$stmt = $db->prepare($query);
		$result = $stmt->execute($query_params);
	} catch (PDOException $ex) {
		die("Failed to run query: " . $ex->getMessage());
		exit();
	}
	$rows = array();

	while($r = $commitments = $stmt->fetch()) {
		$rows[] = $r;
	}
	echo(json_encode($rows));

	?>