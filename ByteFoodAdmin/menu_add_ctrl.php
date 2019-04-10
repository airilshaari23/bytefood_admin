<?php
	include("database.php");

	$db = getDatabase();

	$menu_name = $_POST['menu_name'];
	$menu_type = $_POST['menu_type'];
	$menu_price = $_POST['menu_price'];
	$menu_category = $menu_type == 'food' ? $_POST['menu_categoryf'] : $_POST['menu_categoryd'];	

	$insertResult = $db->insertMenu($menu_name, $menu_type, $menu_price, $menu_category);
	if ($insertResult->status) {
		header("Location: menu_list.php?parent=menu"); /* Redirect browser */
		exit();
	} else {		
		$_SESSION['error'] = $insertResult->error;
		header("Location: menu_add.php?parent=menu"); /* Redirect browser */
		exit();
	}



