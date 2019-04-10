<?php
	include("database.php");

  	$db = getDatabase();

	$menu_name = $_POST['menu_name'];
	$menu_type = $_POST['menu_type'];
	$menu_price = $_POST['menu_price'];
	$menu_status = $_POST['menu_status'];
	$menu_category = $menu_type == 'food' ? $_POST['menu_categoryf'] : $_POST['menu_categoryd'];
	$id = $_POST['id'];

	$updateResult = $db->updateMenuViaId($id, $menu_name, $menu_type, $menu_price, $menu_status, $menu_category);
	
	if ($updateResult->status) {
		header("Location: menu_list.php?parent=menu"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $updateResult->error;
		header("Location: dberror.php?parent=menu"); /* Redirect browser */
		exit();
	}



