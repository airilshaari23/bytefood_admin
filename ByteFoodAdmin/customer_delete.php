<?php
	include("database.php");

	$db = getDatabase();

	$id = $_GET['id'];

	$deleteResult = $db->deleteCustomerViaId($id);

	if ($deleteResult->status) {
		header("Location: customer_list.php?parent=customer"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $deleteResult->error;
		header("Location: dberror.php?parent=customer"); /* Redirect browser */
		exit();
	}
?>


