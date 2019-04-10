<?php
	include("database.php");

  	$db = getDatabase();

	$status = $_POST['status'];
	$type = $_POST['type'];
	$id = $_POST['id'];

	$updateResult = $db->updateAdminViaId($id, $status, $type);
	if ($updateResult->status) {
		header("Location: admin_list.php?parent=admin"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $updateResult->error;
		header("Location: dberror.php?parent=admin"); /* Redirect browser */
		exit();
	}



