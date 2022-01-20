<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__.'/../config.php');
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
	die("Cannot access db.");
}

$db = mysqli_select_db($link,DB_DATABASE);
if(!$db) {
	die("Unable to select database");
}
$categories;
$res = mysqli_query($link,"SELECT count(`tbl_product`.`cat_id`) as `product_count`,`tbl_category`.*
					FROM `tbl_category`
					LEFT JOIN `tbl_product`
					ON `tbl_product`.`cat_id`=`tbl_category`.`cat_id`
					GROUP BY `tbl_category`.`cat_id`;");
while ($row = mysqli_fetch_object($res)) {
	$categories[] = $row;
}
if(is_array($_POST) && count($_POST) > 0) {
	$catname = $_POST['catname'];
	$catdesc = htmlspecialchars($_POST['catdesc']);

	if($catname == '') {
		$errmsg_arr[] = 'Category name missing';
		$errflag = true;
	}

	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.php");
		exit();
	}

	$qry = "INSERT INTO `tbl_category` ( `cat_name`, `cat_description`)
			VALUES ('".$catname."', '".$catdesc."');";
	$result = @mysqli_query($link,$qry);
	
	if($result) {
		$_SESSION['MSGS'] = array('Changes were successful.');
		session_write_close();
		header("location: index.php");
		exit();
	}else {
		die("Query failed: ".mysqli_error($link));
	}
}
if(is_array($_GET) && count($_GET) > 0 && isset($_GET['delete'])) {
	$catid = $_GET['delete'];
	
	$od_id= "`tbl_order`.`od_id`";
	
	$qry = "DELETE FROM `tbl_order`
			WHERE od_id=".$od_id;
	$result = @mysqli_query($link,$qry);
	
	$od_id2= "`tbl_order_item`.`od_id`";
	
	$qry = "DELETE FROM `tbl_order_item`
			WHERE od_id=".$od_id2;
	$result1 = @mysqli_query($link,$qry);
	
	$qry = "DELETE FROM `tbl_product`
			WHERE cat_id=".$catid;
			
	$result2 = mysqli_query($link,$qry);

	$qry = "DELETE FROM `tbl_category`
			WHERE cat_id=".$catid;
	$result3 = mysqli_query($link,$qry);
	
	if($result && $result1 && $result2 && $result3) {
		$_SESSION['MSGS'] = array('Changes were successful.');
		session_write_close();
		header("location: index.php");
		exit();
	}else {
		$_SESSION['ERRMSG_ARR'] = array('<strong>Oh no!</strong> Changes didn\'t happen, make sure your database is up.');
		session_write_close();
		header("location: index.php");
		exit();
	}
}
?>