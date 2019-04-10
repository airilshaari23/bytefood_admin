<?php
	include("database.php");

	$db = getDatabase();

	$id = $_GET['id'];
	$status = $_GET['status'];

	$updateResult = $db->statusCustomerViaId($id, $status);
	
	if ($updateResult->status) {
		header("Location: customer_list.php?parent=customer"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $updateResult->error;
		header("Location: dberror.php?parent=customer"); /* Redirect browser */
		exit();
	}
?>


