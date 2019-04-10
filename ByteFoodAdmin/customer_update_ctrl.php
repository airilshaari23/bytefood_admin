<?php
	include("database.php");

  	$db = getDatabase();

	$status = $_POST['status'];
	$type = $_POST['type'];
	$id = $_POST['id'];

	$updateResult = $db->updateCustomerViaId($id, $status, $type);
	if ($updateResult->status) {
		header("Location: customer_list.php?parent=customer"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $updateResult->error;
		header("Location: dberror.php?parent=customer"); /* Redirect browser */
		exit();
	}



