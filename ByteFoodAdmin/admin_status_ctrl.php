<?php
	include("database.php");

	$db = getDatabase();

	$id = $_GET['id'];
	$status = $_GET['status'];

	$updateResult = $db->statusAdminViaId($id, $status);
	
	if ($updateResult->status) {
		header("Location: admin_list.php?parent=admin"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $updateResult->error;
		header("Location: dberror.php?parent=admin"); /* Redirect browser */
		exit();
	}
?>


