<?php
	include("database.php");
	
	$db = getDatabase();

	$id = $_GET['id'];

	$deleteResult = $db->deleteAdminViaId($id);

	if ($deleteResult->status) {
		header("Location: admin_list.php?parent=admin"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $deleteResult->error;
		header("Location: dberror.php?parent=admin"); /* Redirect browser */
		exit();
	}
?>


