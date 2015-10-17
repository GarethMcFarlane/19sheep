<?php 
// First we execute our common code to connection to the database and start the session
session_start();
require("functions.php");

// We remove the user's data from the session
session_unset();
session_destroy();

// We redirect them to the login page
header("Location: index.php");
die("Redirecting to: login.php");