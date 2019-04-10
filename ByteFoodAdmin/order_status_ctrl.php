<?php
	include("database.php");

	$db = getDatabase();

	$orderno = $_GET['orderno'];
	$status = $_GET['status'];
	$orderdate = $_GET['date'];

	$updateResult = $db->statusOrderViaOrderNo($orderno, $status);

	if ($updateResult->status) {
		header("Location: order_list.php?parent=order&orderdate=$orderdate"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $updateResult->error;
		header("Location: dberror.php?parent=order"); /* Redirect browser */
		exit();
	}
?>


