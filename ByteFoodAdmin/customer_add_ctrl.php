<?php
	include("database.php");

	$db = getDatabase();

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];	

	$insertResult = $db->insertCustomer($name, $username, $password);

	if ($insertResult->status) {
		header("Location: customer_list.php?parent=customer"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $insertResult->error;
		header("Location: customer_add.php?parent=customer"); /* Redirect browser */
		exit();
	}
?>


