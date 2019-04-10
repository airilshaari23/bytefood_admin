<?php
	include("database.php");

	$db = getDatabase();

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];	

	$insertResult = $db->insertAdmin($name, $username, $password);

	if ($insertResult->status) {
		header("Location: admin_list.php?parent=admin"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $insertResult->error;
		header("Location: admin_add.php?parent=admin"); /* Redirect browser */
		exit();
	}



