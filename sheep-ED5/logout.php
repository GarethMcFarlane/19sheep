<?php
require("functions.php");
unset($_SESSION['user']);
header("Location: signin.php");
die("Redirecting: signin.php");
