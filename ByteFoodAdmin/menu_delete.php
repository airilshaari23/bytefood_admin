<?php
	include("database.php");

	$db = getDatabase();

	$id = $_GET['id'];

	$deleteResult = $db->deleteMenuViaId($id);

	if ($deleteResult->status) {
		header("Location: menu_list.php?parent=menu"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $deleteResult->error;
		header("Location: dberror.php?parent=menu"); /* Redirect browser */
		exit();
	}
?>


