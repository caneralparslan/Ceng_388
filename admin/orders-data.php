<?php
require_once(__DIR__.'/../config.php');
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
	die("Cannot access db.");
}

$db = mysqli_select_db($link,DB_DATABASE);
if(!$db) {
	die("Unable to select database");
}
$orders;
$res = mysqli_query($link,"SELECT `tbl_order`.*,GROUP_CONCAT(`pd_name` SEPARATOR ', ')  as `products`
					FROM `tbl_order`,`tbl_order_item`, `tbl_product`
					WHERE `tbl_order`.`od_id` = `tbl_order_item`.`od_id` 
					AND `tbl_product`.`pd_id` = `tbl_order_item`.`pd_id`
					GROUP BY `od_id`");
while ($row = mysqli_fetch_object($res)) {
	$orders[] = $row;
}
$result ="";

				   
if(is_array($_GET) && count($_GET) > 0 && isset($_GET['New'])) {
	$od_status = $_GET['New'];

	$qry = "UPDATE `tbl_order` SET `tbl_order`.`od_status` = 'New' ";
	$result = mysqli_query($link,$qry);
	
	if($result) {
		$_SESSION['MSGS'] = array('Successful changed status to New.');
		session_write_close();
		header("location: index.php");
		exit();
	}
}
else if(is_array($_GET) && count($_GET) > 0 && isset($_GET['Shipped'])) {
	$od_status = $_GET['Shipped'];

	$qry = "UPDATE `tbl_order` SET `tbl_order`.`od_status` = 'Shipped' ";
	$result = mysqli_query($link,$qry);
	if($result) {
		$_SESSION['MSGS'] = array('Successfully changed status to New.');
		session_write_close();
		header("location: index.php");
		exit();
	}
}
else if(is_array($_GET) && count($_GET) > 0 && isset($_GET['Completed'])) {
	$od_status = $_GET['Completed'];

	$qry = "UPDATE `tbl_order` SET `tbl_order`.`od_status` = 'Completed' ";
	$result = mysqli_query($link,$qry);
	if($result) {
		$_SESSION['MSGS'] = array('Successfully changed status to Completed.');
		session_write_close();
		header("location: index.php");
		exit();
	}
}
else if(is_array($_GET) && count($_GET) > 0 && isset($_GET['Cancelled'])) {
	$od_status = $_GET['Cancelled'];

	$qry = "UPDATE `tbl_order` SET `tbl_order`.`od_status` = 'Cancelled' ";
	$result = mysqli_query($link,$qry);
	if($result) {
		$_SESSION['MSGS'] = array('Successfully changed status to Cancelled.');
		session_write_close();
		header("location: index.php");
		exit();
	}
}
else if(is_array($_GET) && count($_GET) > 0 && isset($_GET['delete'])) {
	$od_id = $_GET['delete'];

	$qry = "DELETE FROM `tbl_order_item`
			WHERE od_id=".$od_id;
	$result = mysqli_query($link,$qry);
	

	$qry = "DELETE FROM `tbl_order`
			WHERE od_id=".$od_id;
	$result1 = mysqli_query($link,$qry);
	
	if($result && $result1) {
		$_SESSION['MSGS'] = array('Changes were successful.');
		session_write_close();
		header("location: index.php");
		exit();
	}
	
}

?>