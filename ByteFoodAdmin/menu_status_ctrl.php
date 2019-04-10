<?php
	include("database.php");

	$db = getDatabase();

	$id = $_GET['id'];
	$status = $_GET['status'];

	$updateResult = $db->statusMenuViaId($id, $status);
	
	if ($updateResult->status) {
		header("Location: menu_list.php?parent=menu"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $updateResult->error;
		header("Location: dberror.php?parent=menu"); /* Redirect browser */
		exit();
	}
?>


